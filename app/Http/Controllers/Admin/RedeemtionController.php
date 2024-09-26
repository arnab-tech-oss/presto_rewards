<?php

namespace App\Http\Controllers\Admin;

use App\Events\PushNotification;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Wallet;
use App\Models\RedemptionRequest;
use App\Models\WalletTransaction;
use App\Models\Customer;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Illuminate\Http\Request;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Admin\BaseController;
use App\Mail\RedeemptionStatus;
use App\Mail\redeemptionReject;
use App\Models\EmailLog;
use Throwable;
use App\Events\SentOtpMessage;
use App\Models\Reference;
use App\Models\SettingApp;

class RedeemtionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        // $total_customer = RedemptionRequest::distinct('customer_id')->count('customer_id');
        // $total_amount = RedemptionRequest::sum('amount');
        if ($request->ajax()) {
            //$status = $request->get('status');
            $data =  RedemptionRequest::with('customer', 'coupon.couponRequest.company', 'coupon')->latest('id')->get();

            if ($status && in_array($status, ['approved', 'pending', 'rejected'])) {
                $data = $data->filter(function ($item) use ($status) {
                    return $item->status == $status;
                });
            }
            if ($request->filled('from_date') && $request->filled('end_date')){
                $data = $data->whereBetween('created_at', [$request->from_date, $request->end_date]);
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->with([
                    'total_customer' => $data->count('customer_id'),
                    'total_amount' => $data->sum('amount')
                ])
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" value="' . $row->id . '" name="redeemption" />';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.redeemption.button', ['item' => $row]);
                    return $actionBtn;
                })
                ->rawColumns(['check', 'action'])
                ->make(true);
        }
        return view('admin.redeemption.index', compact('status'));
    }

    public function approve($id)
    {
        $user_id = auth()->user()->id;
        $redemption = RedemptionRequest::with('coupon')->where('id', $id)->first();

        $balanceData = Wallet::where('customer_id', $redemption->customer_id)
            ->select('balance', 'lifetime_credit')
            ->first();

        if ($balanceData) {
            $wallet = Wallet::where('customer_id', $redemption->customer_id)->first();
            $originalBalance = $balanceData->balance;
            $originalLifetimeCredit = $balanceData->lifetime_credit;

            $wallet->balance = $originalBalance + $redemption->amount;
            $wallet->lifetime_credit = $originalLifetimeCredit + $redemption->amount;
            $wallet->save();
            $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
            if ($wallet->save()) {
                $transsaction = new WalletTransaction();
                $transsaction->wallet_id = $wallet->id;
                $transsaction->transactiontype = 'cr';
                $transsaction->amount = $redemption->amount;
                $transsaction->description = "Coupon amount credited to your wallet.";
                $transsaction->status = "CREDITED";
                $transsaction->refference_no = $ref_code;
                $transsaction->date = Carbon::now()->format('Y-m-d');
                $transsaction->created_by = $user_id;
                $transsaction->save();
            }

            if ($transsaction->save()) {
                $redemption->status = 'approved';
                $redemption->save();

                if ($redemption->save()) {

                    $timestamp = Carbon::now();
                    $entity = new Notification();
                    $entity->message = "Congratulations! Your redemption request for Presto Plast India Rewards App has been approved Ref No: $ref_code .Thank You!";
                    $entity->customer_id = $redemption->customer_id;
                    $entity->date_time = $timestamp;
                    $entity->notification_type = "system_gen";
                    $entity->is_read = "unread";
                    $entity->long_content = "Congratulations! Your redemption request for Presto Plast India Rewards App has been approved Ref No: $ref_code .Thank You!";
                    $entity->save();
                }

                if ($entity->save()) {
                    Reference::create([
                        'customer_id' => $entity->customer_id,
                        'references' => $ref_code,
                        'subject' => 'Redemption Request Approved',
                        'user_id' => $user_id,
                        'notification_id' => $entity->id,
                    ]);
                }


                $email_id = Customer::where('id', $redemption->customer_id)->first();

                $mobile = $email_id->phone_number;
                $message = $entity->message;
                event(new SentOtpMessage($message, $mobile));

                if ($email_id->email_id) {
                    // $subject = "Redemption Request Approved - Presto Plast India Rewards App !";
                    // $message = "approved";
                    $this->redemptionstsmail($email_id, $redemption);
                }
                $push_notification = "PrestoRewards: Redemption Approved!";
                $cus_id = $redemption->customer_id;
                $noti_id = $entity->id;
                // $reg_ids = AppSetting::where('customer_id', $cus_id)->latest()->first();
                // $reg_id = $reg_ids->mobile_id;
                // return $reg_id;
                event(new PushNotification($push_notification, $cus_id, $noti_id));
                //return $responsedata;
                // $couponCode = $redemption->coupon->coupon_code;
                return redirect()->route('redeemption')->with('successs', "Coupon Approved Successfully");
            }
        }
    }

    public function reject(Request $request)
    {
        //$id = $request->input('itemId');
        $redemption = RedemptionRequest::with('coupon')->where('id', $request->itemId)->first();
        if ($redemption) {
            $redemption->update([
                'status' => "rejected",
                'admin_comment' => $request->rejectionReason
            ]);
            $customer = Customer::where('id', $redemption->customer_id)->first();

            $timestamp = Carbon::now();
            $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
            $entity = new Notification();
            $entity->message = "We regret to inform you that your redemption request for Presto Plast India Rewards App has been rejected. Ref No: $ref_code . Please visit our support page for assistance.";
            $entity->customer_id = $redemption->customer_id;
            $entity->date_time = $timestamp;
            $entity->notification_type = "system_gen";
            $entity->is_read = "unread";
            $entity->long_content = "We are excited to inform you that your redemption request has been rejected. Check your PrestoRewards app for more details";
            $entity->save();

            if ($entity->save()) {
                Reference::create([
                    'customer_id' => $entity->customer_id,
                    'references' => $ref_code,
                    'subject' => 'Redemption Request rejected',
                    'user_id' => auth()->user()->id,
                    'notification_id' => $entity->id,
                ]);
            }

            // if ($entity->save()) {
            //     $transsaction = new WalletTransaction();
            //     $transsaction->wallet_id = $wallet->id;

            //     $transsaction = $transsaction->wallet_id;
            //     $transsaction->save();
            // }
            if ($customer->email_id) {
                // $subject = "Redemption Request Rejected - Presto Plast India Rewards App !";
                // $message = "rejected";
                $this->redemptionrejectmail($customer, $redemption);
            }
            $push_notification = "PrestoRewards: Redemption Rejected!";
            $cus_id = $redemption->customer_id;
            $noti_id = $entity->id;
            event(new PushNotification($push_notification, $cus_id, $noti_id));
        }
        //return redirect()->route('redeemption');
        $data = ['messagee' => 'coupon rejected'];
        return response($data);
    }

    public function ajaxAllApproved(Request $request)
    {
        $user_id = auth()->user()->id;
        $id_arr = json_decode($request->redeemptionReq, true);
        for ($i = 0; $i < count($id_arr); $i++) {

            $redemption = RedemptionRequest::where('id', $id_arr[$i])->first();

            $balanceData = Wallet::where('customer_id', $redemption->customer_id)
                ->select('balance', 'lifetime_credit')
                ->first();

            if ($balanceData) {
                $wallet = Wallet::where('customer_id', $redemption->customer_id)->first();
                $originalBalance = $balanceData->balance;
                $originalLifetimeCredit = $balanceData->lifetime_credit;

                $wallet->balance = $originalBalance + $redemption->amount;
                $wallet->lifetime_credit = $originalLifetimeCredit + $redemption->amount;
                $wallet->save();
                if ($wallet->save()) {
                    $transsaction = new WalletTransaction();
                    $transsaction->wallet_id = $wallet->id;
                    $transsaction->transactiontype = 'cr';
                    $transsaction->amount = $redemption->amount;
                    $transsaction->status = "CREDITED";
                    $transsaction->date = Carbon::now()->format('Y-m-d');
                    $transsaction->created_by = $user_id;
                    $transsaction->save();
                }

                if ($transsaction->save()) {
                    $redemption->status = 'approved';
                    $redemption->save();

                    if ($redemption->save()) {

                        $timestamp = Carbon::now();

                        $entity = new Notification();
                        $entity->message = "Your coupan redeemed";
                        $entity->customer_id = $redemption->customer_id;
                        $entity->date_time = $timestamp;
                        $entity->notification_type = "system_gen";
                        $entity->long_content = "We are excited to inform you that your redemption request has been approved. Check your PrestoRewards app for more details";
                        $entity->save();
                    }
                }
            }
        }  //end of foor loop

        $return_data = array("message" => "Approved Successfully", "status" => "success");
        return json_encode($return_data);
    }

    public function ajaxAllreject(Request $request)
    {
        $user_id = auth()->user()->id;
        $id_arr = json_decode($request->redeemptionReq, true);
        for ($i = 0; $i < count($id_arr); $i++) {

            $redemption = RedemptionRequest::where('id', $id_arr[$i])->first();

            if ($redemption) {
                $redemption->update([
                    'status' => "rejected",
                    'admin_comment' => $request->rejectionReason
                ]);
                $customer = Customer::where('id', $redemption->customer_id)->first();

                $timestamp = Carbon::now();
                $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
                $entity = new Notification();
                $entity->message = "We regret to inform you that your redemption request for Presto Plast India Rewards App has been rejected. Ref No: $ref_code . Please visit our support page for assistance.";
                $entity->customer_id = $redemption->customer_id;
                $entity->date_time = $timestamp;
                $entity->notification_type = "system_gen";
                $entity->is_read = "unread";
                $entity->long_content = "We are excited to inform you that your redemption request has been rejected. Check your PrestoRewards app for more details";
                $entity->save();

                if ($entity->save()) {
                    Reference::create([
                        'customer_id' => $entity->customer_id,
                        'references' => $ref_code,
                        'subject' => 'Redemption Request rejected',
                        'user_id' => auth()->user()->id,
                        'notification_id' => $entity->id,
                    ]);
                }

                // if ($entity->save()) {
                //     $transsaction = new WalletTransaction();
                //     $transsaction->wallet_id = $wallet->id;

                //     $transsaction = $transsaction->wallet_id;
                //     $transsaction->save();
                // }
                if ($customer->email_id) {
                    // $subject = "Redemption Request Rejected - Presto Plast India Rewards App !";
                    // $message = "rejected";
                    $this->redemptionrejectmail($customer, $redemption);
                }
                $push_notification = "PrestoRewards: Redemption Rejected!";
                $cus_id = $redemption->customer_id;
                $noti_id = $entity->id;
                event(new PushNotification($push_notification, $cus_id, $noti_id));
            }
            //return redirect()->route('redeemption');

        }
        $return_data = array("message" => "coupon rejected", "status" => "success");
        return json_encode($return_data);
    }


    public function pending()
    {
        return view('admin.redeemption.pending');
    }
    public function rejected()
    {
        return view('admin.redeemption.rejected');
    }

    public function redemptionstsmail($email, $data)
    {
        // try{
        $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
        $currentDate = Carbon::now()->format('Y-m-d');
        $maildata = [
            'title' => 'Redeemtion Update',
            'amount' => $data->amount,
            'coupon_id' => $data->coupon->coupon_code,
            'status' => $data->status,
            'first_name' => $email->first_name,
            'last_name' => $email->last_name,
            'referance_code' => $ref_code,
            'currentDate' => $data->updated_at,
        ];
        Mail::to($email->email_id)->send(new RedeemptionStatus($maildata, $ref_code));
        // }catch(Throwable $t)
        // {
        //     Log::error('mail sending fail: ' . $t->getmessage());
        // }
    }

    public function redemptionrejectmail($email, $data)
    {
        try {
            $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
            $currentDate = Carbon::now()->format('Y-m-d');
            $maildata = [
                'title' => 'Redeemtion Update',
                'amount' => $data->amount,
                'coupon_id' => $data->coupon->coupon_code,
                'status' => $data->status,
                'first_name' => $email->first_name,
                'last_name' => $email->last_name,
                'referance_code' => $ref_code,
                'currentDate' => $data->updated_at,
                'reason' => $data->admin_comment,
            ];
            $setting_data = SettingApp::first();
            if ($setting_data) {
                $ccEmails = explode(',', $setting_data->cc);
                $bccEmails = explode(',', $setting_data->Bcc);
                Mail::to($email->email_id)->cc($ccEmails)->bcc($bccEmails)->send(new redeemptionReject($maildata, $ref_code));
            } else {
                Mail::to($email->email_id)->send(new redeemptionReject($maildata, $ref_code));
            }
            EmailLog::create([
                'ref_no' => $ref_code,
                'from' => env('MAIL_FROM_ADDRESS'),
                'to' => $email->email_id,
                'subject' => 'Redemption Request Rejected - Presto Plast India Rewards App Ref No: ' . $ref_code,
                'body' => "This Mail is Send for Redemption Request Reject",
                'date' => Carbon::now()->format('d-m-y'),
            ]);
        } catch (Throwable $t) {
            Log::error('mail sending fail: ' . $t->getmessage());
        }
    }
}
