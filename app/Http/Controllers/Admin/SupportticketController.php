<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\PushNotification;
use App\Http\Controllers\Admin\BaseController;
use App\Mail\Ticketmail;
use App\Models\Customer;
use App\Models\CustomerEnquire;
use App\Models\Enquiry;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use DateTime;
use App\Mail\SupportMail;
use App\Mail\UpdatesupportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Exception;
use Throwable;

class SupportticketController extends Controller
{
    public $page = 'ticket';
    public function ticketlist(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerEnquire::with('customer')->orderByDesc('id')->get();
            return datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     $checked = $row->status == 'open' ? 'checked' : '';
                //     return '<div class="form-check form-switch form-switch-md mb-2">
                //         <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('support.tickit.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                //         <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                //     </div>';
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.supportticketmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.supportticketmanagement.ticketlist');
    }
    // public function ticket()
    // {
    //      $tickitno = rand(100000000, 999999999);
    //     return view('admin.supportticketmanagement.ticketadd',compact('tickitno'));
    // }
    public function add()
    {
        $customers = Customer::where('status', 'active')->where('deleted_at', null)->get();
        $enquiries = Enquiry::get();
        $tickitno = date("Y-m-d") . '-PRESSPR-' . substr(md5(uniqid(rand(), true)), -20, 4);
        $products = Product::all();
        //$tickitno = rand(100000000, 999999999);
        return view('admin.supportticketmanagement.ticketadd', compact('tickitno', 'customers', 'enquiries','products'));
    }
    public function ticketadd(Request $request)
    {
        $validatedata = Validator::make($request->all(), [
            'customer_id' => 'required',
            'ticket_no' => 'required',
            'message' => 'required',
            'mode' => 'required',
        ]);
        // return $request->all();
        if ($validatedata->fails()) {
            return redirect()->back()->withErrors($validatedata)->withInput();
        } else {
            $ticketadd = new CustomerEnquire();
            $ticketadd->customer_id = $request->customer_id;
            $ticketadd->subject = $request->subject;
            $ticketadd->type = $request->type;
            $ticketadd->ticket_no = $request->ticket_no;
            $ticketadd->reply_by = 'customer';
            $ticketadd->product_id = $request->product_list;
            $ticketadd->mode = $request->mode;
            $ticketadd->save();
        }
        if ($ticketadd->save()){
            $data = new Conversation();
                $data->ticket_no = $request->ticket_no;
                $data->message = $request->message;
                $data->reply = 'customer';
                $data->save();
        }
        if ($data->save()) {
            $notification = new Notification();
            $notification->customer_id =  $ticketadd->customer_id;
            $notification->message = 'Ticket Added Successsfully';
            $notification->date_time = Carbon::now();
            $notification->is_read = 'unread';
            $notification->notification_type = 'system_gen';
            $notification->user_id = auth()->user()->id;
            $notification->long_content = "Thank you for reaching out to PrestoRewards support. Your request has been received,";
            $notification->save();
        }

        $customer = Customer::where('id', $ticketadd->customer_id)->first();
        if ($customer->email_id !== '') {
            $this->ticketmail($customer->email_id, $ticketadd->id);
        }
        return view('admin.supportticketmanagement.ticketlist');
    }

    public function tickit_status($id)
    {
        $customer_sts = CustomerEnquire::where('id', $id)->first();

        if ($customer_sts->status == "close") {
            $customer_sts->status = "open";
            $customer_sts->save();
            if ($customer_sts->save()); {
                return redirect()->route('admin.supportticketmanagement.ticketlist');
            }
        } else {

            $customer_sts->status = "close";
            $customer_sts->save();
            if ($customer_sts->save()); {
                return redirect()->route('admin.supportticketmanagement.ticketlist');
            }
        }
    }

    public function ticket_view($id)
    {

        $view_ticet = CustomerEnquire::with('customer', 'convertation')->where('id', $id)->first();
        $data = Conversation::where('ticket_no', $view_ticet->ticket_no)->where('reply', 'customer')->update([
            'status' => 'read',
        ]);
        return view('admin.supportticketmanagement.ticketview', compact('view_ticet'));
    }

    public function comments(Request $request)
    {
        // $customers = CustomerEnquire::with('customer')->get();
        // return view('admin.supportticketmanagement.comments', compact('customers'));
        if ($request->ajax()) {
            $data = CustomerEnquire::with('customer')->get();
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 'open') {
                        $status = "<span class='badge bg-warning'>OPEN</span>";
                    } else {
                        $status = "<span class='badge bg-success'>CLOSE</span>";
                    }

                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.supportticketmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.supportticketmanagement.comments');
    }

    public function view($id)
    {
        $data = CustomerEnquire::with('customer')->where('id', $id)->first();

        $conversation = Conversation::selectRaw('*, DATE(created_at) as date')
            ->where('ticket_no', $data->ticket_no)
            //->groupBy('created_at')
            ->orderBy('created_at')
            ->get();
        $status = Conversation::where('ticket_no', $data->ticket_no)->where('reply', 'customer')->update([
            'status' => 'read',
        ]);
        //return $conversation;

        return view('admin.supportticketmanagement.chat', compact('data', 'conversation'));
    }

    public function messege(Request $request)
    {
        //return $request->all();
        $imageName = null;
        $validatedata = Validator::make($request->all(), [
            'message' => 'required',
            'ticket_no' => 'required|exists:conversations,ticket_no'
        ]);

        if ($validatedata->fails()) {
            return redirect()->back()->withErrors($validatedata)->withInput();
        } else {

            $id = auth()->user()->id;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                if (!File::exists("images/enquiry")) {
                    File::makeDirectory("images/enquiry");
                }
                $request->image->move(public_path('images/enquiry'), $imageName);
                $fullPath = 'images/enquiry/' . $imageName;
            }

            $entity = new Conversation();
            $entity->ticket_no = $request->ticket_no;
            $entity->message = $request->message;
            $entity->status = "reply";
            $entity->reply_by = $id;
            $entity->reply = "admin";
            if ($imageName !== null) {
                $entity->image = $fullPath;
            }
            $entity->save();
            if ($entity->save()) {
                $customerEnquire = CustomerEnquire::where('ticket_no', $request->ticket_no)->first();
                $customerEnquire->update([
                    'reply_by' => 'admin',
                ]);
                $customer_id = $customerEnquire->customer_id; // Extract customer_id from the object
                //$ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
                $data = new Notification();
                $data->customer_id = $customer_id;
                $data->message = "We've replied to your support request $request->ticket_no. Check your email or log in to your app for details.";
                $data->is_read = "unread";
                $data->date_time = Carbon::now();
                $data->notification_type = "admin_gen";
                $data->user_id = $id;
                $data->created_by = $id;
                $data->save();
                if ($request->status === 'close') {
                    $customerEnquire->update([
                        'status' => 'close',
                    ]);
                }
            }
            $cus_details = Customer::where('id', $customerEnquire->customer_id)->first();

            $maildata = [
                'token_no' => $request->ticket_no,
                'user_name' => $cus_details->first_name,
            ];
            $push_notification = "We've replied to your support request $request->ticket_no. Check your email or log in to your app for details";
            $cus_id = $customer_id;
            $noti_id = $data->id;
            event(new PushNotification($push_notification, $cus_id, $noti_id));
            if ($cus_details->email_id) {
                try {
                    Mail::to($cus_details->email_id)->send(new UpdatesupportMail($maildata, $request->ticket_no));
                } catch (Throwable $t) {
                    Log::error('mail sending fail: ' . $t->getmessage());
                }
            }


            return redirect()->route('admin.support.comment');
        }
    }

    public function enquiryread($id)
    {
        $enquiryread = CustomerEnquire::with('customer')->where('id', $id)->first();

        if ($enquiryread->status == 'unread') {
            $enquiryread->status = 'read';
            $enquiryread->save();
        }
        return view('admin.customermanagement.Enquirydetails', compact('enquiryread'));
    }
    public function replymessage(Request $request, $id)
    {
        $customer_reply = CustomerEnquire::where('id', $id)->first();

        $ticketNumber = Uuid::uuid4()->toString();

        $customer_reply->reply = $request->reply;
        $customer_reply->reply_date = now();
        $customer_reply->ticket_number = $ticketNumber;
        $customer_reply->update();

        return redirect()->route('admin.enquiry');
    }
    public function ticketmail($email_id, $id)
    {
        $data = CustomerEnquire::with('customer')->where('id', $id)->first();
        try {
            $ref_code = (string) rand(100000000, 999999999);
            $maildata = [
                'title' => 'Ticket Added Successfully',
                'ticket_no' => $data->ticket_no,
                'customer_id' => $data->customer->first_name . ' ' . $data->customer->last_name,
            ];
            Mail::to($email_id)->send(new Ticketmail($maildata, $ref_code));
        } catch (Throwable $t) {
            Log::error('Mail sending failed: ' . $t->getMessage());
        }
    }

    public function changestatus($id)
    {
        $data = CustomerEnquire::where('id', $id)->first();
        $data->update([
            'status' => 'close',
        ]);

        return redirect()->route('admin.support.comment');
    }
}
