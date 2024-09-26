<?php

namespace App\Http\Controllers\User;

use App\GatewayTraits\GatewayTraits;
use App\GatewayTraits\StatusTraits;
use App\Models\Payout;
use App\Models\Customer;
use App\Models\PayoutTransaction;
use App\Models\Wallet;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\Reference;
use Illuminate\Support\Facades\Mail;
use App\Mail\PayoutMail;
use Illuminate\Http\Request;
use App\Events\SentOtpMessage;
use Illuminate\Support\Carbon;
use App\Models\EmailLog;
use Throwable;
use App\Models\WalletTransaction;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayoutController extends Controller
{
    use GatewayTraits;
    use StatusTraits;

    public function payout(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'payment_type' => 'required',
            // 'amount' => 'required',
            'upi_id' => 'required_if:payment_type,upi',
            'bank_name' => 'required_if:payment_type,bank',
            'bank_ac' => 'required_if:payment_type,bank',
            'ifsc' => 'required_if:payment_type,bank',
            // 'phone' => 'required|numeric|digits:10',
            // 'customer_name' => 'required',
            'amount' => 'required',
            //'upi_id' => 'required',
            'customer_name' => 'required',
            'phone' => 'required|numeric|digits:10',
        ]);

        //  dd($validateData);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            $id = auth('sanctum')->user()->id;
            $data = Customer::where('id', $id)->first();
            $currentDate = Carbon::now()->format('ymd');
            $seq = Payout::latest()->first();
            $seqnumber = sprintf("%010d", ($seq->id ?? 0) + 1);
            $randomNumber = str_pad(mt_rand(1, 99999), 4, '0', STR_PAD_LEFT);
            $ref_no = substr($currentDate, 0, 6) . $request->amount . $randomNumber;
            $seq_no = "ICI" . $currentDate . $seqnumber;

            try {
                DB::transaction(function () use ($ref_no, $id, $request, $data, $seq_no) {
                    Payout::create([
                        'ref_no' => $ref_no,
                        'cus_id' => $id,
                        'amount' => $request->amount,
                        'payment_type' => $request->payment_type,
                        'upi_id' => $request->upi_id,
                        'seq_no' => $seq_no,
                        'bank_ac' => $request->bank_ac,
                        'ifsc' => $request->ifsc,
                        'bank' => $request->bank_name,
                        'phone' => $request->phone,
                        'customer_name' => $request->customer_name,
                        'status' => 'INITIATED',
                    ]);

                    $data = Wallet::where('customer_id', $id)->first();
                    $balance = $data->balance - $request->amount;
                    $life_debit = $data->lifetime_debit + $request->amount;

                    Wallet::where('customer_id', $id)->update([
                        'balance' => $balance,
                        'lifetime_debit' => $life_debit,
                    ]);

                    WalletTransaction::create([
                        'wallet_id' => $data->id,
                        'transactiontype' => 'dr',
                        'amount' => $request->amount,
                        'description' => 'Payout Request Generated',
                        'date' => Carbon::now(),
                        'refference_no' => $ref_no,
                        'status' => "WIP",
                        'source' => "tobank",
                    ]);

                    Notification::create([
                        'customer_id' => $id,
                        'message' => "payout request is process",
                        'date_time' => Carbon::now(),
                        'is_read' => "unread",
                        'notification_type' => "system_gen",
                    ]);

                    //$bank_upi = $this->bankupi();

                    // if ($data->email_id) {
                    //     $this->payoutMail($data->email_id);
                    // }
                    // db::commit();
                });

                if ($request->payment_type == 'upi') {
                    $req_arr = [
                        'seq_no' => $seq_no,
                        'upi_id' => $request->upi_id,
                        'amount' => $request->amount
                    ];
                    $bank_resp = $this->bankupi($req_arr);
                } else {
                    $payout_trans = Payout::where('ref_no', $ref_no)->first();
                    payouttransaction::create([
                        'ref_no' => $ref_no,
                        'bank_ref' => '',
                        'amount' => $request->amount,
                        'status' => 'rejected',
                        'payout_id' => $payout_trans->id,
                        'message' => 'neft rejected',
                        'bankrrn' => $bank_resp['BankRRN'] ?? '',
                        'upitranlog_id' => '',
                        'seq_no' => $seq_no,
                        'mobileappdata' => '',
                    ]);
                    Payout::where('id', $payout_trans->id)->update([
                        'status' => 'FAILED',
                    ]);
                    $wallet_txn = WalletTransaction::where('refference_no', $ref_no)->first();

                    WalletTransaction::where('refference_no', $ref_no)->update([
                        'status' => 'REVERSED',
                    ]);
                    $wallet_amount = Wallet::where('id', $wallet_txn->wallet_id)->first();
                    $wal_bal = $wallet_amount->balance + $request->amount;
                    $wal_db = $wallet_amount->lifetime_debit - $request->amount;
                    Wallet::where('id', $wallet_amount->id)->update([
                        'balance' => $wal_bal,
                        'lifetime_debit' => $wal_db,
                    ]);

                    $customer = Payout::with('transaction')->where('ref_no', $ref_no)->first();

                    $bank_data = [
                        // 'bank_resp' => $bank_resp,
                        'payout_details' => $customer,
                    ];
                    $cus_det = Customer::where('id', $id)->first();
                    $maildata = [
                        'name' => $cus_det->first_name,
                        'ref_no' => $ref_no,
                        'bank_rrn' => '',
                        'amount' => $request->amount,
                        'status' => 'Failed',
                        'blade_status' => 'Failed',
                        'date' => Carbon::now()->format('d-m-y H:i'),
                        'reff_no' => date("Y-m") . '-presto-' . substr(md5(uniqid(rand(), true)), -20, 4),
                    ];
                    $message = "We regret to inform you that your payout request for Presto Plast India Rewards App has failed. Ref No: $ref_no. Please visit our support page https://www.prestorewardsapp.com/support-and-help-center for assistance.";

                    $mobile = $cus_det->phone_number;

                    $responseData = event(new SentOtpMessage($message, $mobile));

                    try {

                        if ($cus_det->email_id != null) {
                            Mail::to($cus_det->email_id)->send(new PayoutMail($maildata));
                        }
                        EmailLog::create([
                            'ref_no' => $ref_no,
                            'from' => env('MAIL_FROM_ADDRESS'),
                            'to' => $cus_det->email_id,
                            'subject' => ' Payout Request Process' . $maildata['ref_no'] .'- Presto Plast India Rewards App - Ref No:' . $maildata['reff_no'],
                            'body' => "This Mail is Send for Failed Payout Request",
                            'date' => Carbon::now()->format('d-m-y'),
                          ]);
                    } catch (Throwable $t) {
                        Log::error('mail sending fail: ' . $t->getmessage());
                    }

                    // If the transaction completes without exceptions, return success
                    return response()->json(responseData($bank_data, 'Payout Request is rejected', false));
                    // return response()->json(responseData(null, 'neft not ready yet', false));
                }

                //db::commit();

                // if($request->payment_type == 'upi'){
                //     $req_imps = [

                //     ];
                // }


                //$responce_data = var_dump($bank_upi);
                // $bank_resp = json_decode($bank_upi, true);


                $payout_trans = Payout::where('ref_no', $ref_no)->first();
                $faild_code = ['11', '12', '13', '14', '37', '39', '31', 'XH', 'ZD', 'XP', 'XV', 'YC', 'YE', 'UT', 'U01', 'U07', 'U08', 'U10', 'U13', 'U16', 'U17', 'U55', 'U49', 'U50', 'U53', 'XQ', 'XS', 'XU', 'XW', 'Y1', 'YB', 'YD', 'YF', 'OU11', 'XY', 'U29', 'U30', 'U31', 'U32', 'U33', 'U34', 'U67', '1', '4', '9', '10', '16', '17', '18', '23', '38', '55', 'U09', 'U17', 'U18', 'U26', 'U80', '27', '1025', '98', 'M3', 'M1', '1036', 'Z9', 'U96', 'U78', 'B03', 'B3', 'IR', 'NO', 'UX', 'XB', 'XC', 'YG', '27', 'ZE', 'ZH', 'ZX', 'ZY', 'T02', 'T03', 'T04', 'T05', 'T14', 'A09', 'R06', '66', '67', '68', '69', 'ZO', 'ZG', 'X1', 'Z8', 'M4', 'XZ', '96', 'Z5', 'ZI', '51', '36', 'K1', '53', 'B07', '32', '22', '33', 'CC8', 'G27', 'S93', 'S94', 'S95', 'S96', 'S97', 'S98'];
                $error_code = ['5', '91', '6', '9999', 'U28', 'L05', 'L16', '72', '73', '74', 'U27', 'BT', 'RB', 'RR', 'U68', 'U70', 'U88', '101', '95', '99', '94', '92', 'T13', '1033', 'U90', 'U91', 'U86', 'U89', 'U81', 'U84', '1830', 'U92', 'U93', 'U94', '1051'];

                if (isset($bank_resp['response']) && $bank_resp['response'] == '0') {

                    $UpiTranlogId  = $bank_resp['UpiTranlogId'];
                    //return $bank_upi->UpiTranlogId;
                    $payout5 = payouttransaction::create([
                        'ref_no' => $ref_no,
                        'bank_ref' => $UpiTranlogId,
                        'amount' => $request->amount,
                        'status' => 'success',
                        'payout_id' => $payout_trans->id,
                        'message' => $bank_resp['message'],
                        'bankrrn' => $bank_resp['BankRRN'],
                        'upitranlog_id' => $UpiTranlogId,
                        'seq_no' => $seq_no,
                        'mobileappdata' => $UpiTranlogId,
                        'response_code' => $bank_resp['response']
                    ]);

                    Payout::where('id', $payout_trans->id)->update([
                        'status' => 'COMPLETED',
                    ]);
                    WalletTransaction::where('refference_no', $ref_no)->update([
                        'status' => 'DEBITED',
                        'description' => 'Amount debited from your wallet for bank withdrawal.',
                    ]);

                    $customer = Payout::with('transaction')->where('ref_no', $ref_no)->first();

                    $bank_data = [
                        'bank_resp' => $bank_resp,
                        'payout_details' => $customer,
                    ];
                    $cus_det = Customer::where('id', $id)->first();

                    $maildata = [
                        'name' => $cus_det->first_name,
                        'ref_no' => $ref_no,
                        'bank_rrn' => $bank_resp['BankRRN'],
                        'amount' => $request->amount,
                        'status' => 'Successful',
                        'blade_status' => 'successfully',
                        'date' => Carbon::now()->format('d-m-y h:i A'),
                        'reff_no' => date("Y-m") . '-presto-' . substr(md5(uniqid(rand(), true)), -20, 4),
                        'mail_message' => "Your transaction is complete.",
                    ];
                    $message = "Your payout request for Presto Plast India Rewards App has been successfully processed. Ref No: $ref_no. Bank RRN: $payout5->bankrrn. Your transaction is complete. Thank You!";

                    $mobile = $cus_det->phone_number;

                    $responseData = event(new SentOtpMessage($message, $mobile));

                    try {

                        if ($cus_det->email_id != null) {
                            Mail::to($cus_det->email_id)->send(new PayoutMail($maildata));
                            Reference::create([
                                'customer_id' => $cus_det->id,
                                'references' => $ref_no,
                                'subject' => 'payout success',
                                'user_id' => auth()->user()->id,
                            ]);
                            EmailLog::create([
                                'ref_no' => $ref_no,
                                'from' => env('MAIL_FROM_ADDRESS'),
                                'to' => $cus_det->email_id,
                                'subject' => ' Payout Request Process' . $maildata['ref_no'] .'- Presto Plast India Rewards App - Ref No:' . $maildata['reff_no'],
                                'body' => "This Mail is Send for Successfull Payout",
                                'date' => Carbon::now()->format('d-m-y'),
                              ]);
                        }
                    } catch (Throwable $t) {
                        Log::error('mail sending fail: ' . $t->getmessage());
                    }

                    // If the transaction completes without exceptions, return success
                    return response()->json(responseData($bank_data, 'Payout Request is success amount is credited in your bank ', true));
                } else if (isset($bank_resp['response']) && in_array($bank_resp['response'], $faild_code)) {
                    $UpiTranlogId  = $bank_resp['UpiTranlogId'];
                    payouttransaction::create([
                        'ref_no' => $ref_no,
                        'bank_ref' => $UpiTranlogId,
                        'amount' => $request->amount,
                        'status' => 'rejected',
                        'payout_id' => $payout_trans->id,
                        'message' => $bank_resp['message'],
                        'bankrrn' => $bank_resp['BankRRN'] ?? '',
                        'upitranlog_id' => $UpiTranlogId,
                        'seq_no' => $seq_no,
                        'mobileappdata' => $UpiTranlogId,
                        'response_code' => $bank_resp['response']
                    ]);
                    Payout::where('id', $payout_trans->id)->update([
                        'status' => 'FAILED',
                    ]);
                    $wallet_txn = WalletTransaction::where('refference_no', $ref_no)->first();

                    WalletTransaction::where('refference_no', $ref_no)->update([
                        'status' => 'REVERSED',
                        'description' => 'Transaction reversed, amount credited back to your wallet.',
                    ]);
                    $wallet_amount = Wallet::where('id', $wallet_txn->wallet_id)->first();
                    $wal_bal = $wallet_amount->balance + $request->amount;
                    $wal_db = $wallet_amount->lifetime_debit - $request->amount;
                    Wallet::where('id', $wallet_amount->id)->update([
                        'balance' => $wal_bal,
                        'lifetime_debit' => $wal_db,
                    ]);

                    $customer = Payout::with('transaction')->where('ref_no', $ref_no)->first();

                    $bank_data = [
                        'bank_resp' => $bank_resp,
                        'payout_details' => $customer,
                    ];
                    $cus_det = Customer::where('id', $id)->first();
                    $maildata = [
                        'name' => $cus_det->first_name,
                        'ref_no' => $ref_no,
                        'bank_rrn' => $bank_resp['BankRRN'],
                        'amount' => $request->amount,
                        'status' => 'Failed',
                        'blade_status' => 'Failed',
                        'date' => Carbon::now()->format('d-m-y H:i'),
                        'reff_no' => date("Y-m") . '-presto-' . substr(md5(uniqid(rand(), true)), -20, 4),
                        'mail_message' => "Please visit our support page https://www.prestorewardsapp.com/support-and-help-center for assistance",
                    ];
                    $message = "We regret to inform you that your payout request for Presto Plast India Rewards App has failed. Ref No: $ref_no. Please visit our support page https://www.prestorewardsapp.com/support-and-help-center for assistance.";

                    $mobile = $cus_det->phone_number;

                    $responseData = event(new SentOtpMessage($message, $mobile));

                    try {

                        if ($cus_det->email_id != null) {
                            Mail::to($cus_det->email_id)->send(new PayoutMail($maildata));
                            Reference::create([
                                'customer_id' => $cus_det->id,
                                'references' => $ref_no,
                                'subject' => 'Payout Failed',
                                'user_id' => auth()->user()->id,
                            ]);
                            EmailLog::create([
                                'ref_no' => $ref_no,
                                'from' => env('MAIL_FROM_ADDRESS'),
                                'to' => $cus_det->email_id,
                                'subject' => ' Payout Request Process' . $maildata['ref_no'] .'- Presto Plast India Rewards App - Ref No:' . $maildata['reff_no'],
                                'body' => "This Mail is Send for Failed Payout Request",
                                'date' => Carbon::now()->format('d-m-y'),
                              ]);
                        }
                    } catch (Throwable $t) {
                        Log::error('mail sending fail: ' . $t->getmessage());
                    }

                    // If the transaction completes without exceptions, return success
                    return response()->json(responseData($bank_data, 'Payout Request is rejected', false));
                } else if (isset($bank_resp['response']) && in_array($bank_resp['response'], $error_code)) {
                    $UpiTranlogId  = $bank_resp['UpiTranlogId'];
                    payouttransaction::create([
                        'ref_no' => $ref_no,
                        'bank_ref' => $UpiTranlogId,
                        'amount' => $request->amount,
                        'status' => 'pending',
                        'payout_id' => $payout_trans->id,
                        'message' => $bank_resp['message'],
                        'bankrrn' => $bank_resp['BankRRN'] ?? '',
                        'upitranlog_id' => $UpiTranlogId,
                        'seq_no' => $seq_no,
                        'mobileappdata' => $UpiTranlogId,
                        'response_code' => $bank_resp['response']
                    ]);

                    Payout::where('id', $payout_trans->id)->update([
                        'status' => 'INITIATED',
                    ]);
                    $wallet_txn = WalletTransaction::where('refference_no', $ref_no)->update([
                        'status' => 'WIP',
                    ]);

                    $customer = Payout::with('transaction')->where('ref_no', $ref_no)->first();

                    $bank_data = [
                        'bank_resp' => $bank_resp,
                        'payout_details' => $customer,
                    ];
                    $cus_det = Customer::where('id', $id)->first();
                    $maildata = [
                        'name' => $cus_det->first_name,
                        'ref_no' => $ref_no,
                        'bank_rrn' => $bank_resp['BankRRN'],
                        'amount' => $request->amount,
                        'status' => 'Pending',
                        'blade_status' => 'Pending',
                        'date' => Carbon::now()->format('d-m-y H:i'),
                        'reff_no' => date("Y-m") . '-presto-' . substr(md5(uniqid(rand(), true)), -20, 4),
                        'mail_message' => "We will update you soon once we receive a response from the banks. You can also check the latest status from your app.
                        Please visit our support page https://www.prestorewardsapp.com/support-and-help-center for assistance
                        ",
                    ];
                    $message = "Your payout request for Presto Plast India Rewards App is currently pending from the bank's side. Ref No: $ref_no. We will update you soon once we receive a response from the banks. You can also check the latest status from your app. Please visit our support page https://www.prestorewardsapp.com/support-and-help-center for assistance. Thank You!";

                    $mobile = $cus_det->phone_number;

                    $responseData = event(new SentOtpMessage($message, $mobile));

                    try {

                        if ($cus_det->email_id != null) {
                            Mail::to($cus_det->email_id)->send(new PayoutMail($maildata));

                            Reference::create([
                                'customer_id' => $cus_det->id,
                                'references' => $ref_no,
                                'subject' => 'payout Pending',
                                'user_id' => auth()->user()->id,
                            ]);
                            EmailLog::create([
                                'ref_no' => $ref_no,
                                'from' => env('MAIL_FROM_ADDRESS'),
                                'to' => $cus_det->email_id,
                                'subject' => ' Payout Request Process' . $maildata['ref_no'] .'- Presto Plast India Rewards App - Ref No:' . $maildata['reff_no'],
                                'body' => "This Mail is Send for Pending Payout Request",
                                'date' => Carbon::now()->format('d-m-y'),
                              ]);
                        }
                    } catch (Throwable $t) {
                        Log::error('mail sending fail: ' . $t->getmessage());
                    }
                    // If the transaction completes without exceptions, return success
                    return response()->json(responseData($bank_data, 'Payout Request is process ', true));
                }

                // $customer = Payout::with('transaction')->where('ref_no', $ref_no)->first();

                // $bank_data = [
                //     'bank_resp' => $bank_resp,
                //     'payout_details' => $customer,
                // ];
                // // If the transaction completes without exceptions, return success
                // return response()->json(responseData($bank_data, 'Payout Request is process ', true));
            } catch (\Exception $e) {
                // If an exception occurs, rollback the transaction and return failure
                DB::rollBack();
                return response()->json(responseData(null, $e->getMessage(), false));
            }
        }
    }

    public function bankupi($req_arr)
    {
        $arr = [
            'seq_no' => $req_arr['seq_no'],
            'payee_va' => $req_arr['upi_id'],
            'amount' => $req_arr['amount'],
            'x_priority' => '1000'
        ];
        return  $this->upi($arr);
    }

    public function bankimps()
    {
        $arr = [

            'x_priority' => '0100',
        ];
        return $this->imps($arr);
    }

    // public function neft()
    // {
    //     $arr = [
    //         'x_priority' => '0010',
    //         'tranRefNo' => '202307061943045',
    //     ]
    // }

    public function statuscheck(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $data1 = Payout::with('transaction')->where('ref_no', $request->ref_no)->where(function ($query) {
            $query->where('status', 'COMPLETED')
                ->orWhere('status', 'FAILED');
        })->first();
        if ($data1) {
            $customer = [
                'data' => $data1,
            ];
            return response()->json(responseData($customer, 'transaction details'));
        }

        $data = Payout::where('ref_no', $request->ref_no)->where('status', 'INITIATED')->first();
        $currentDate = Carbon::now()->format('Ymd');
        $seq = Payout::latest()->first();
        $seqnumber = sprintf("%010d", ($seq->id ?? 0) + 1);
        $nseq_no = "ICI" . $currentDate . $seqnumber;
        $timestamp = strtotime($currentDate);
        $formattedDate = date("d/m/Y", $timestamp);
        if ($data) {
            $stat_arr = [
                'ori_seq_no' => $data->seq_no,
                'seq_no' => $nseq_no,
                'date' => $formattedDate,
            ];
            $status_resp = $this->upistatus($stat_arr);


            if (isset($status_resp['response']) && $status_resp['response'] == '0') {

                $UpiTranlogId  = $status_resp['UpiTranlogId'];
                //return $bank_upi->UpiTranlogId;
                payouttransaction::where('ref_no', $request->ref_no)->update([
                    'bank_ref' => $UpiTranlogId,
                    'status' => 'approved',
                    'message' => $status_resp['message'],
                    'bankrrn' => $status_resp['BankRRN'],
                    'upitranlog_id' => $UpiTranlogId,
                    'mobileappdata' => $UpiTranlogId,
                    'response_code' => $status_resp['response']
                ]);

                Payout::where('id', $data->id)->update([
                    'status' => 'COMPLETED',
                ]);
                WalletTransaction::where('refference_no', $request->ref_no)->update([
                    'status' => 'DEBITED',
                ]);
            }

            $customer1 = Payout::with('transaction')->where('cus_id', $id)->where('ref_no', $request->ref_no)->first();
            $status_res = [
                //'bank_resp' => $status_resp,
                'data' => $customer1,
            ];
            if ($customer1) {
                return response()->json(responseData($status_res, "status response"));
            }
        };
    }

    public function upistatus($stat_arr)
    {
        $arr = [
            'x_priority' => '1000',
            'ori_seq_no' => $stat_arr['ori_seq_no'],
            'seq_no' => $stat_arr['seq_no'],
            'date' => $stat_arr['date'],
        ];
        return $this->upistatuscheck($arr);
    }

    public function impsstatus()
    {
        $arr = [
            'x_priority' => '0100',
        ];
        return $this->impsstatuscheck($arr);
    }

    // public function bank()
    // {
    //     $data = Payout::where('status', 'pending')->get();
    //     $randomString = Str::random(10);
    //     foreach ($data as $payout) {
    //         $payout->status = 'approved';
    //         $payout->bank_ref = Str::random(10);
    //         $payout->save();

    //         $generatedData[] = [
    //             'id' => $payout->id,
    //             'status' => $payout->status,
    //         ];
    //     }
    //     $this->callback($generatedData);

    //     return response()->json(responseData($generatedData,"success"));
    // }

    // public function callback($generatedData)
    // {
    //     foreach($generatedData as $data){
    //         $ref_no = Payout::select('ref_no')->where('id',$data['id']);
    //         if($data->status == 'approved'){
    //             $transaction = WalletTransaction::where('refference_no',$ref_no)->first();
    //             $transaction->status = "approve";
    //             $transaction->save();
    //         }
    //     }
    //     return;
    // }

    public function bank(Request $request)
    {
        $data = Payout::where('ref_no', $request->ref_no)->first();

        $randomString = Str::random(10);
        $data->status = $request->status;
        $data->bank_ref = $randomString;
        $data->save();
        if ($data->save()) {
            $id = $data->cus_id;
            $timestamp = Carbon::now();
            $entity = new Notification();
            $entity->customer_id = $id;
            if ($request->status == 'approved') {
                $entity->message = 'Payment Successful';
            } else {
                $entity->message = 'payment Not Successful';
            }
            $entity->date_time = $timestamp;
            $entity->is_read = 'unread';
            $entity->notification_type = 'system_gen';
            $entity->save();
            if ($entity->save()) {
                $entity1 = new PayoutTransaction();
                $entity1->ref_no = $request->ref_no;
                $entity1->amount = $data->amount;
                if ($request->status == 'approved') {
                    $entity1->status = "approved";
                    $entity1->message = "payment successfull";
                } else {
                    $entity1->status = "rejected";
                    $entity1->message = "payment not successfull";
                }
                $entity1->bank_ref = $randomString;
                $entity1->payout_id = $data->id;
                $entity1->transaction_no = $randomString;
                $entity1->save();
            }
            if ($entity1->save()) {
                return response()->json(responseData(null, "success"));
            } else {
                return response()->json(responseData(null, "success", false));
            }
        }
    }

    public function callback(Request $request)
    {
        $data = Payout::where('ref_no', $request->ref_no)->first();

        if ($data->status == "approved") {
            $transaction = WalletTransaction::where('refference_no', $request->ref_no)->first();
            $transaction->status = "approve";
            $transaction->save();
        } elseif ($data->status == "reject") {
            $transaction2 = WalletTransaction::where('refference_no', $request->ref_no)->first();
            $transaction2->status = "rejected";
            $transaction2->save();
            if ($transaction2->save()) {
                $wallet = Wallet::where('customer_id', $data->cus_id)->first();
                $wallet->balance = $wallet->balance + $data->amount;
                $wallet->lifetime_debit = $wallet->lifetime_debit - $data->amount;
                $wallet->save();
            }
        }

        if (isset($transaction) && $transaction->save()) {
            return response()->json(responseData(null, "Transaction successful"));
        }

        if (isset($wallet) && $wallet->save()) {
            return response()->json(responseData(null, "Transaction declined", false));
        }
    }

    public function payouttransaction()
    {
        $id = auth('sanctum')->user()->id;
        $data = Payout::with('transaction')->where('cus_id', $id)->orderBy('created_at', 'desc')->get();
        if ($data) {
            return response()->json(responseData($data, "transaction retrive successfully"));
        } else {
            return response()->json(responseData(null, "something went wrong", false));
        }
    }


    // public function payoutMail($email)
    // {
    //     if ($email) {
    //         $maildata = [
    //             'title' => "Your Payment is under process!",
    //             'body' => "This is for Payout Mail"
    //         ];

    //         Mail::to($email)->send(new PayoutMail($maildata));
    //     }
    // }
}
