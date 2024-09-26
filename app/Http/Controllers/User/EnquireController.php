<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SupportMail;
use App\Models\Conversation;
use App\Models\Customer;
use App\Models\CustomerEnquire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Enquiry;
use Illuminate\Support\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Support\Facades\Log;

class EnquireController extends Controller
{
    public function enquire(Request $request)
    {
        $imageName = null;
        $enquire = Validator::make($request->all(), [

            'subject' => 'required',
            'message' => 'required',
            'type' => 'required|exists:enquiries,enquiry_type',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'product_id' => 'required_if:type,product_enquiry'
        ]);

        if ($enquire->fails()) {
            return response()->json(responseData(null, $enquire->errors(), false));
        } else {

            $id = auth('sanctum')->user()->id;
            $customer = Customer::where('id', $id)->first();

            $randomString = date("Y-m-d") . '-PRESSPR-' . substr(md5(uniqid(rand(), true)), -20, 4);

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                if (!File::exists("images/enquiry")) {
                    File::makeDirectory("images/enquiry");
                }
                $request->image->move(public_path('images/enquiry'), $imageName);
                $fullPath = 'images/enquiry/' . $imageName;
            }

            $entity = new CustomerEnquire();
            $entity->customer_id = $id;
            $entity->subject = $request->subject;
            $entity->type = $request->type;
            $entity->ticket_no = $randomString;
            $entity->product_id = $request->product_id;
            $entity->reply_by = 'customer';
            $entity->mode = 'app';
            $entity->save();

            if ($entity->save()) {
                $storedEntity = CustomerEnquire::find($entity->id);

                $token = $storedEntity->ticket_no;

                $data = new Conversation();
                $data->ticket_no = $token;
                if ($imageName !== null) {
                    $data->image = $fullPath;
                }
                $data->message = $request->message;
                $data->reply = 'customer';
                $data->save();
            }
            if ($data->save()) {
                $response = [
                    'ticket_no' => $token,
                ];
                $maildata = [
                    'token_no' => $token,
                    'user_name' => $customer->first_name,
                ];

                //$ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);

                Notification::create([
                    'customer_id' => $id,
                    'message' => 'We have received your support request ' . $token . ' and will respond within 24 hours. Thank you for your patience.',
                    'date_time' => Carbon::now(),
                    'is_read' => 'unread',
                    'notification_type' => "system_gen",
                ]);

                if ($customer->email_id) {
                    try {
                        Mail::to($customer->email_id)->send(new SupportMail($maildata, $token));
                    } catch (Throwable $t) {
                        Log::error('mail sending fail: ' . $t->getmessage());
                    }
                }

                return response()->json(responseData($response, "Enquire save successfully"));
            }
        }
    }

    public function list()
    {
        $id = auth('sanctum')->user()->id;
        $data = CustomerEnquire::with('convertation')->where('customer_id', $id)->orderBy('created_at', 'desc')->get();

        if ($data->isNotEmpty()) {
            return response()->json(responseData($data, "conversation list"));
        } else {
            return response()->json(responseData(null, "no data found", false));
        }
    }

    public function conversation(Request $request)
    {
        $data = Validator::make($request->all(), [
            'ticket_no' => 'required|exists:conversations,ticket_no',
        ]);

        if ($data->fails()) {
            return response()->json(responseData(null, $data->errors(), false));
        } else {
            $status = Conversation::where('ticket_no', $request->ticket_no)->where('reply', 'admin')->update([
                'status' => 'read',
            ]);
            $convertation = Conversation::where('ticket_no', $request->ticket_no)->orderBy('created_at', 'desc')->get();
        }

        if ($convertation->isNotEmpty()) {
            return response()->json(responseData($convertation, "all conversation"));
        } else {
            return response()->json(responseData(null, "no convertasion found", false));
        }
    }

    public function reply(Request $request)
    {
        $imageName = null;
        $id = auth('sanctum')->user()->id;
        $data = Validator::make($request->all(), [
            'ticket_no' => 'required|exists:conversations,ticket_no',
            'message' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($data->fails()) {
            return response()->json(responseData(null, $data->errors(), false));
        } else {

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                if (!File::exists("images/enquiry")) {
                    File::makeDirectory("images/enquiry");
                }
                $request->image->move(public_path('images/enquiry'), $imageName);
                $fullPath = 'images/enquiry/' . $imageName;
            }
            $cus_enquery = CustomerEnquire::where('ticket_no',$request->ticket_no)->first();

            $entity = new Conversation();
            $entity->ticket_no = $request->ticket_no;
            $entity->message = $request->message;
            if ($imageName !== null) {
                $entity->image = $fullPath;
            }
            $entity->reply = 'customer';
            $entity->save();

            $cus_enquery->update([
                'reply_by' => 'customer',
            ]);

            if($cus_enquery->status == 'close'){
                $cus_enquery->update([
                    'status' => 'open',
                ]);
            }
        }
        if ($entity->save()) {
            return response()->json(responseData(null, "thank you for texting"));
        } else {
            return response()->json(responseData(null, "something went wrong", false));
        }
    }

    public function enquerytype()
    {
        $data = Enquiry::get();
        return response()->json(responseData($data, "Enquery type get"));
    }
}
