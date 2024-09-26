<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Mail\ValidateMail;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Notification;
use App\Models\Otp;
use App\Models\Product;
use App\Models\ProductCatalog;
use App\Models\RefferlCode;
use App\Models\Role;
use App\Models\SettingApp;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;
use App\Models\State;
use Exception;
use App\Events\SentOtpMessage;
use App\Models\AppSetting;
use App\Models\EmailLog;
use App\Models\Reference;
use App\Models\WalletTransaction;
use Throwable;
use Illuminate\Support\Facades\Log;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;

class CustomerController extends Controller
{
  public function addcustomer(Request $request)
  {

    $ValidateData = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'phone_number' => 'required|numeric|unique:customers,phone_number|digits:10',
      'passcode' => 'required|digits:6',
      'password' => 'required',
      'gender' => 'required',
      'dob' => 'required',
      'address_1' => 'required',
      'state_id' => 'required',
      'postal_code' => 'required',
      'role_type' => 'required',
      'question' => 'required',
      'answer' => 'required',
      //'ref_code' => 'sometimes|exists:refferl_codes,code'
    ]);
    //return $request->all();

    if ($ValidateData->fails()) {
      $message = $ValidateData->errors();
      return response()->json(responseData(null, $message, false));
    } else {

      $role_id = Role::where('role_name', $request->role_type)->first();
      $ref_code = strtolower(substr($request->first_name, 0, 4) . substr($request->phone_number, -4));


      if ($request->ref_code != null) {
        $cus_id = RefferlCode::where('code', $request->ref_code)->first();
        if (!$cus_id) {
          return response()->json(responseData(null, "please enter valid refferl code", false));
        }
      }

      $fullPath = null;
      if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->extension();
        if (!File::exists("images/profilepicture")) {
          File::makeDirectory("images/profilepicture");
        }
        $request->image->move(public_path('images/profilepicture'), $imageName);
        $fullPath = 'images/profilepicture/' . $imageName;
      }
      //$state = State::where('district', $request->state_id)->first();
      DB::beginTransaction();
      try {
        $entity = new Customer();

        $entity->first_name = $request->first_name;
        $entity->last_name = $request->last_name;
        $entity->email_id = $request->email_id;
        $entity->phone_number = $request->phone_number;
        $entity->passcode = $request->passcode;
        $entity->password = Hash::make($request->password);
        $entity->gender = $request->gender;
        $entity->dob = $request->dob;
        $entity->question = $request->question;
        $entity->answer = $request->answer;
        $entity->new_role_id = $role_id->id;
        if ($fullPath !== null) {
          $entity->image = $fullPath;
        }
        $entity->verify = "false";
        $entity->reffer_code = $cus_id->customer_id ?? null;
        $entity->save();

        if ($entity->save()) {
          $customer = Customer::where('phone_number', $request->phone_number)->first();
          $entity2 = new CustomerAddress();
          $entity2->customer_id = $customer->id;
          $entity2->address_1 = $request->address_1;
          $entity2->address_2 = $request->address_2;
          $entity2->state_id = $request->state_id;
          $entity2->postal_code = $request->postal_code;
          $entity2->save();
        }

        if ($entity2->save()) {
          $id = $entity->id;
          $wallet = new Wallet();
          $wallet->customer_id = $id;
          $wallet->lifetime_credit = "0.00";
          $wallet->lifetime_debit = "0.00";
          $wallet->save();
        }

        if ($wallet->save()) {
          $timestamp = Carbon::now();
          $notification = new Notification();
          $notification->customer_id = $entity->id;
          $notification->message = "you successfully registered";
          $notification->date_time = $timestamp;
          $notification->is_read = "unread";
          $notification->notification_type = "system_gen";
          $notification->save();
        }
        if ($notification->save()) {
          RefferlCode::create([
            'code' => $ref_code,
            'customer_id' => $entity->id,
          ]);
        }

        DB::commit();

        if ($request->email_id) {
          $this->registrationMail($request->email_id, $request->phone_number, $request->password, $request->passcode, $notification);
        }
        $customer = Customer::with('refferlcode')->select('id', 'phone_number', 'email_id', 'verify')->where('phone_number', $request->phone_number)->first();
        return response()->json(responseData($customer, "Customer added successfully."));
      } catch (Exception $e) {
        DB::rollBack();
        //return response()->json(responseData(null, "Customer not added successfully", false));
        return response()->json(responseData(null, $e->getMessage(), false));
      }
    }
  }

  public function view()
  {
    $id = auth('sanctum')->user()->id;
    $baseURL = request()->root();
    $customer = customer::with('address.customerstate', 'refferlcode')->where('id', $id)->first();
    if ($customer->image != null) {
      $customer->image = $baseURL . '/' . $customer->image;
    } else {
      if ($customer->gender == 'Male') {
        $customer->image = $baseURL . '/assets/images/users/male.jpeg';
      } else {
        $customer->image = $baseURL . '/assets/images/users/female.jpeg';
      }
    }

    return response()->json(responseData($customer, "customer data retrive"));
  }

  public function customerupdate(Request $request)
  {
    $id = auth('sanctum')->user()->id;
    $imageName = null;
    $validatedData = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'gender' => 'required',
      'dob' => 'required',
      'address_1' => 'required',
      'state_id' => 'required',
      'postal_code' => 'required',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);


    if ($validatedData->fails()) {
      $message = $validatedData->errors();
      return response()->json(responseData(null, $message, false));
    } else {

      if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->extension();
        if (!File::exists("images/profilepicture")) {
          File::makeDirectory("images/profilepicture");
        }
        $request->image->move(public_path('images/profilepicture'), $imageName);
        $fullPath = 'images/profilepicture/' . $imageName;
      }

      $customer = Customer::where('id', $id)->first();



      $customer->first_name = $request->first_name;
      $customer->last_name = $request->last_name;
      $customer->gender = $request->gender;
      $customer->dob = $request->dob;
      if ($imageName !== null) {
        $customer->image = $imageName ? $fullPath : $customer->image;
      }
      CustomerAddress::where('customer_id', $id)->update([
        'address_1' => $request->address_1,
        'address_2' => $request->address_2,
        'state_id' => $request->state_id,
        'postal_code' => $request->postal_code,
      ]);


      $customer->update($customer->toArray());

      if ($customer->update()) {
        $data = Customer::with('address.customerstate')->where('id', $id)->first();
        $baseURL = request()->root();
        if ($data->image != null) {
          $data->image = $baseURL . '/' . $customer->image;
        } else {
          if ($data->gender == 'male') {
            $data->image = $baseURL . '/assets/images/users/male.jpeg';
          } else {
            $data->image = $baseURL . '/assets/images/users/female.jpeg';
          }
        }
        return response()->json(responseData($data, "Update Successfully"));
      } else {
        return response()->json(responseData(null, "failed", false));
      }
    }
  }

  public function document(Request $request)
  {
    $docimg = null;
    $fullimg = null;
    $id = auth('sanctum')->user()->id;
    $validatedData = Validator::make($request->all(), [
      'doc_type' => 'required',
      'doc_number' => 'required',
      'doc_img' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:1024',
      'image' => 'nullable|image',
    ]);

    if ($validatedData->fails()) {
      $message = $validatedData->errors();
      return response()->json(responseData(null, $message, false));
    } else {

      if ($request->hasFile('doc_img')) {
        $docimg = time() . '.' . $request->file('doc_img')->extension();
        if (!File::exists("images/docimage")) {
          File::makeDirectory("images/docimage");
        }
        $request->doc_img->move(public_path('images/docimage'), $docimg);
        $fullPath = 'images/docimage/' . $docimg;
      }

      if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->extension();
        if (!File::exists("images/profilepicture")) {
          File::makeDirectory("images/profilepicture");
        }
        $request->image->move(public_path('images/profilepicture'), $imageName);
        $fullimg = 'images/profilepicture/' . $imageName;
      }

      $data = Customer::where('id', $id)->first();
      $data->doc_type = $request->doc_type;
      $data->doc_number = $request->doc_number;
      $data->doc_img = $fullPath;
      if ($fullimg !== null) {
        $data->image = $fullimg;
      }
      $data->verify = 'true';
      $data->update($data->toArray());
      if ($data->update()) {
        $wallet_details = Wallet::where('customer_id', $id)->first();
        $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
        $wallet_details->update([
          'balance' => $wallet_details->balance + 50,
          'lifetime_credit' => $wallet_details->lifetime_credit + 50,
        ]);
        WalletTransaction::create([
          'wallet_id' => $wallet_details->id,
          'transactiontype' => 'cr',
          'amount' => 50,
          'refference_no' => $ref_code,
          'description' => "Special introductory offer credited to your wallet.",
          'status' => "CREDITED",
          'date' => Carbon::now()->format('d-m-y H:i'),
        ]);
        $timestamp = Carbon::now();
        $notification = new Notification();
        $notification->customer_id = $id;
        $notification->message = "Congratulations! Your profile verification for Presto Plast India Rewards App was successful. Welcome aboard! Ref No: {$ref_code}. Thank You!";
        $notification->date_time = $timestamp;
        $notification->is_read = "unread";
        $notification->notification_type = "system_gen";
        $notification->long_content = "profile has been successfully verified";
        $notification->save();
        if ($data->email_id) {
          $subject = "Profile Verification Success - Welcome to Presto Plast India Rewards App!";
          $messagee = "Success";
          $this->validationMail($data->email_id, $id, $subject, $messagee, $notification);
        }

        $mobile = $data->phone_number;
        $message = $notification->message;

        $responseData = event(new SentOtpMessage($message, $mobile));
        // if (isset($responseData[0]['status']) && $responseData[0]['status'] == 'success' && strval($responseData[0]['statusCode']) == '200') {
        //   return response()->json(responseData(null, "otp verified"));
        // }
      }
    }

    if ($notification) {
      $baseURL = request()->root();
      $customer = Customer::where('id', $id)->first();

      if ($customer) {
        $customer->image = $baseURL . '/' . $customer->image;
        $customer->doc_img = $baseURL . '/' . $customer->doc_img;
      }

      // $cus_details = Customer::where('id', $id)->first();
      // $mobile = $cus_details->phone_number;
      // $message = $notification->message;

      //$responseData = event(new SentOtpMessage($message, $mobile));
      // if (isset($responseData[0]['status']) && $responseData[0]['status'] == 'success' && strval($responseData[0]['statusCode']) == '200') {
      //   return response()->json(responseData($customer, "Document uploded successfully"));
      // } else {
      //   return response()->json(responseData(null, "something went wrong", false));
      // }
      return response()->json(responseData($customer, "Document uploded successfully.profile verified"));
    } else {
      return response()->json(responseData(null, "something went wrong", false));
    }
  }


  public function registrationMail($email, $phone, $password, $passcode, $notification)
  {
    try {
      $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
      $customer = Customer::where('phone_number', $phone)->first();
      //$logo = SettingApp::select('applogo')->first();
      $maildata = [
        'title' => "Congratulations! You Have Successfully Registered – Welcome to Presto Plast Reward!",
        'name' => $customer->first_name,
        'phone' => $phone,
        'password' => $password,
        'passcode' => $passcode,
        'referance_code' => $ref_code
      ];
      Mail::to($email)->send(new RegistrationMail($maildata, $ref_code));
      Reference::create([
        'customer_id' => $customer->id,
        'references' => $ref_code,
        'note' => $notification->message,
        'notification_id' => $notification->id,
      ]);

      EmailLog::create([
        'ref_no' => $ref_code,
        'from' => env('MAIL_FROM_ADDRESS'),
        'to' => $email,
        'subject' => ' Welcome to PrestoRewards! Ref No: ' . $ref_code,
        'body' => "This Mail is Send for New Customer Registration",
        'date' => Carbon::now()->format('d-m-y'),
      ]);
    } catch (Throwable $t) {
      Log::error('mail sending fail: ' . $t->getmessage());
    }
  }

  public function validationMail($email, $id, $subject, $message, $notification)
  {
    try {
      $ref_code = date("Y-m") . '-PRESTO-' . substr(md5(uniqid(rand(), true)), -20, 4);
      $customer = Customer::where('id', $id)->first();
      //$logo = SettingApp::select('applogo')->first();
      $maildata = [
        'title' => "Congratulations! Your PrestoRewards profile has been successfully verified. Unlock more features and benefits",
        'name' => $customer->first_name,
        'email' => $customer->email_id,
        'referance_code' => $ref_code,
        'message' => $message ?? '',
        'file' => public_path($customer->doc_img),
      ];

      // $pdf = PDF::loadView('pdf');

      Mail::to($email)->send(new ValidateMail($maildata, $ref_code, $subject));
      Reference::create([
        'customer_id' => $customer->id,
        'references' => $ref_code,
        'subject' => $notification->message,
        'notification_id' => $notification->id,
      ]);
    } catch (Throwable $t) {
      Log::error('mail sending fail: ' . $t->getmessage());
    }
  }

  public function sendotp()
  {
    $id = auth('sanctum')->user()->id;
    $otp_details = Otp::where('cus_id', $id)->first();

    $customer = Customer::where('id', $id)->first();

    if ($customer->verify == 'true') {
      return response()->json(responseData(null, "profile already verified", false));
    }

    if ($otp_details) {
      $otp_details->update([
        'updated_at' => Carbon::now(),
      ]);
      $otp = $otp_details->otp;
    } else {
      $otp = rand(1111, 9999);
      $data = Otp::create([
        'cus_id' => $id,
        'otp' => $otp,
        'updated_at' => Carbon::now(),
      ]);
    }

    $data1 = Otp::where('cus_id', $id)->first();

    $cus_details = Customer::where('id', $id)->first();



    $message = "Welcome to Presto Plast India Rewards App! Your OTP for profile verification is  $otp . Please enter it to complete your registration. Thank you!";

    $mobile = $cus_details->phone_number;

    $responseData = event(new SentOtpMessage($message, $mobile));

    if (isset($responseData[0]['status']) && $responseData[0]['status'] == 'success' && strval($responseData[0]['statusCode']) == '200') {
      return response()->json(responseData($data1, "otp send successfull"));
    } else {
      return response()->json(responseData(null, "otp send failed", false));
    }
  }

  public function otpvalidation(Request $request)
  {
    $validateData = Validator::make($request->all(), [
      'otp' => 'required'
    ]);

    if ($validateData->fails()) {
      $message = $validateData->errors();
      return response()->json(responseData(null, $message, false));
    } else {
      $id = auth('sanctum')->user()->id;
      $data = Otp::where('cus_id', $id)->where('otp', $request->otp)->first();

      if ($data) {
        Otp::where('cus_id', $id)->delete();
        //$cus_details = Customer::where('id', $id)->first();
        // $cus_details->update([
        //   'verify' => 'true',
        // ]);
        // $wallet_details = Wallet::where('customer_id',$id)->first();
        // $wallet_details->update([
        //   'balance' => $wallet_details->balance + 50,
        //   'lifetime_credit' => $wallet_details->lifetime_credit + 50,
        // ]);
        // WalletTransaction::create([
        //   'wallet_id' => $wallet_details->id,
        //   'transactiontype' => 'cr',
        //   'amount' => 50,
        //   'description' => "for profile verification",
        //   'date' => Carbon::now()->format('d-m-y H:i'),
        // ]);
        // $timestamp = Carbon::now();
        // $ref_code = (string) rand(100000000, 999999999);
        // $notification = new Notification();
        // $notification->customer_id = $id;
        // $notification->message = "Congratulations! Your profile verification for Presto Plast India Rewards App was successful. Welcome aboard! Ref No: {$ref_code}. Thank You!";
        // $notification->date_time = $timestamp;
        // $notification->is_read = "unread";
        // $notification->notification_type = "system_gen";
        // $notification->long_content = "profile has been successfully verified";
        // $notification->save();
        // if ($cus_details->email_id) {
        //   $subject = "Profile Verification Success - Welcome to Presto Plast India Rewards App!";
        //   $messagee = "Success";
        //   $this->validationMail($cus_details->email_id, $id, $subject, $messagee, $notification);
        // }

        // $mobile = $cus_details->phone_number;
        // $message = $notification->message;

        // $responseData = event(new SentOtpMessage($message, $mobile));
        // if (isset($responseData[0]['status']) && $responseData[0]['status'] == 'success' && strval($responseData[0]['statusCode']) == '200') {
        //   return response()->json(responseData(null, "otp verified"));
        // }
        return response()->json(responseData(null, "otp verified"));
      } else {
        return response()->json(responseData(null, "otp not verified", false));
      }
    }
  }

  public function appsetting(Request $request)
  {
    $id = auth('sanctum')->user()->id;

    $data = AppSetting::create([
      'customer_id' => $id,
      'mobile_id' => $request->mobile_id
    ]);

    return response()->json(responseData($data, "device id stored sussessfully"));
  }

  public function customer_delete(Request $request)
  {
    $ValidateData = Validator::make($request->all(), [
      'cus_id' => 'required',
    ]);

    if ($ValidateData->fails()) {
      $message = $ValidateData->errors();
      return response()->json(responseData(null, $message, false));
    }else{
      $customer = Customer::where('id', $request->cus_id)->first();
      $customer->update([
        'status' => 'block',
      ]);

      $wallet = Wallet::where('customer_id',$customer->id)->delete();

      return response()->json(responseData(null,"account delete successfully"));
    }
  }
}
