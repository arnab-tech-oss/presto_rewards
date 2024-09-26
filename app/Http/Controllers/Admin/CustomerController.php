<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\State;
use Ramsey\Uuid\Uuid;
use App\Models\Wallet;
use APP\Models\BankAccount;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\RefferlCode;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use Illuminate\Support\Carbon;
use App\Models\CustomerAddress;
use App\Models\CustomerEnquire;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Coupon;
use Throwable;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class CustomerController extends Controller
{
  public $page = 'Customer';
  public function customerlist(Request $request)
  {
    if ($request->ajax()) {
      $data = Customer::with('address.customerstate','refferlcode')->latest();
      if ($request->filled('from_date') && $request->filled('end_date')){
        $data = $data->whereBetween('created_at', [$request->from_date, $request->end_date]);
    }
      return datatables::of($data)
        ->addIndexColumn()
        ->addColumn('status', function ($row) {
          $checked = $row->status == 'active' ? 'checked' : '';
          return '<div class="form-check form-switch form-switch-md mb-2">
                  <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('customer.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                  <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
              </div>';
        })
        ->addColumn('action', function ($row) {
          $actionBtn = view('admin.customermanagement.button', ['item' => $row, 'page' => $this->page]);
          return $actionBtn;
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
    return view('admin.customermanagement.customerlist');
  }

  public function status($id)
  {

    $user_id = auth()->id();
    $status = Customer::where('id', $id)->first();

    if ($status->status == "active") {
      $customer = Customer::where('id', $id)
        ->update(['status' => 'block', 'updated_by' => $user_id]);

      if ($customer) {
        Wallet::where('customer_id', $id)
          ->update(['status' => 'inactive', 'updated_by' => $user_id]);
      }

      return "Block";
    } else {
      Customer::where('id', $id)
        ->update(['status' => 'active', 'updated_by' => $user_id]);
      Wallet::where('customer_id', $id)
        ->update(['status' => 'active', 'updated_by' => $user_id]);
      return "Active";
    }
  }




  public function customeradd()
  {
    $roles = Role::get();

    $states = State::distinct('state')->pluck('state');
    //$districts = State::get();
    $pass = rand(100000000, 999999999);
    $pin = "123456";
    return view('admin.customermanagement.addcustomer', compact('roles', 'pass', 'pin', 'states'));
  }

  public function district($state)
  {
    $districts = State::where('state', $state)->get();
    return response()->json($districts);
  }

  public function addcustomer(Request $request)
  {
    $ValidateData = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'phone_number' => 'required|numeric|unique:customers,phone_number|digits:10',
      'gender' => 'required',
      'dob' => 'required',
      'address_1' => 'required',
      //'address_2' => 'required',
      'state' => 'required',
      'district' => 'required',
      'postal_code' => 'required',
      // 'role_name' => 'required',
    ]);

    if ($ValidateData->fails()) {
      return redirect()->back()->withErrors($ValidateData)->withInput();
    } else {

      $role_id = Role::where('role_name', $request->role_type)->first();
      //$state = State::where('district', $request->state_id)->first();
      DB::beginTransaction();
      try {
        $entity = new Customer();

        $entity->first_name = $request->first_name;
        $entity->last_name = $request->last_name;
        $entity->email_id = $request->email_id;
        $entity->phone_number = $request->phone_number;
        $entity->passcode = $request->pass_code;
        $entity->password = Hash::make($request->password);
        $entity->gender = $request->gender;
        $entity->dob = $request->dob;
        // $entity->question = $request->question;
        // $entity->answer = $request->answer;
        $entity->new_role_id = 2;
        $entity->created_by = auth()->user()->id;
        $entity->verify = "false";
        $entity->alternative_ph_number = $request->alt_phone_number;
        $entity->save();

        if ($entity->save()) {
          $ref_code = strtolower(substr($request->first_name, -4, 4) . substr($request->phone_number, -4));
          RefferlCode::create([
            'code' => $ref_code,
            'customer_id' => $entity->id,
          ]);
        }


        if ($entity->save()) {
          $customer = Customer::where('phone_number', $request->phone_number)->first();
          $entity2 = new CustomerAddress();
          $entity2->customer_id = $customer->id;
          $entity2->address_1 = $request->address_1;
          $entity2->address_2 = $request->address_2;
          $entity2->state_id = $request->district;
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
          $notification->long_content = "Thank you for registered new customer. Your request has been received,";
          $notification->save();
        }

        DB::commit();

        if ($request->email_id) {
          $this->registrationMail($request->email_id, $request->phone_number, $request->password, $request->pass_code);
        }
        return redirect()->route('admin.customerlist')->with('success', 'Customer added successfully');
      } catch (Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()]);
      }
    }
  }



  public function customerenquiry()
  {

    $customers = CustomerEnquire::with('customer')->get();
    return view('admin.customermanagement.customerenquiry', compact('customers'));
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

  public function registrationMail($email, $phone, $password, $passcode)
  {
    try {
      $ref_code = (string) rand(100000000, 999999999);
      $customer = Customer::where('phone_number', $phone)->first();
      $maildata = [
        'title' => "Congratulations! You Have Successfully Registered – Welcome to Presto Plast Reward!",
        'name' => $customer->first_name,
        'phone' => $phone,
        'password' => $password,
        'passcode' => $passcode,
        'referance_code' => $ref_code
      ];
      Mail::to($email)->send(new RegistrationMail($maildata, $ref_code));
    } catch (Throwable $t) {
      Log::error('mail sending fail: ' . $t->getmessage());
    }
  }

  public function viewcustomer($id)
  {
    $customer = Customer::with('address.customerstate')->where('id', $id)->first();
    return view('admin.customermanagement.customerview', compact('customer'));
  }

  public function editcustomer($id)
  {
    $states = State::distinct('state')->pluck('state');
    $cust = Customer::with('address.customerstate','address')->where('id', $id)->first();
    $districts = State::where('state', $cust->address->customerstate->state)->get();
    $state = State::select('state')->distinct()->get();
    //return $cust;
    return view('admin.customermanagement.customeredit', compact('cust', 'states', 'state', 'districts'));
  }

  public function updatecustomer(Request $request, $id)
  {
    $userid = auth()->id();
    $validator = Validator::make($request->all(), [
      'first_name' => 'required',
      'last_name' => 'required',
      'gender' => 'required',
      'dob' => 'required',
      //'password' => 'required',
      'passcode' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    } else {
      $customer_update = Customer::where('id', $id)->first();


      $customer_update->first_name = $request->first_name;
      $customer_update->last_name = $request->last_name;
      $customer_update->gender = $request->gender;
      $customer_update->dob = $request->dob;
      $customer_update->updated_by = $userid;
      $customer_update->password = Hash::make($request->password);
      $customer_update->passcode = $request->passcode;
      $customer_update->verify = $request->verify;
      $customer_update->update($customer_update->toArray());

      $cus_address =  CustomerAddress::where('customer_id', $customer_update->id)->first();
      $cus_address->address_1 = $request->address_1;
      $cus_address->address_2 = $request->address_2;
      $cus_address->state_id = $request->state_id;
      $cus_address->update($cus_address->toArray());

      if ($customer_update->update()) {
        return redirect()->route('admin.customerlist')->with('update_success', 'Company Update Successfully');
      } else {
        return redirect()->back()->with('error', 'Failed to update company.');
      }
    }
  }


  function deletecustomer($id)
  {
    $data = Customer::where('id', $id)->first();
    $wallet = Wallet::where('customer_id',$id)->first();

    if (!$data) {
      return response()->json(['error' => 'Record not found'], 404);
    } else if ($wallet->balance > 0) {
      return response()->json(['data' => 'wallet have balance donot delete customer']);
    }else{
      $data->delete();
      Wallet::where('customer_id', $data->id)->delete();
      Notification::where('customer_id', $data->id)->delete();
      BankAccount::where('customer_id', $data->id)->delete();
      return response()->json(['message' => 'Record delete successfully']);
    }
  }

  public function serachproduct($id)
  {
    $data = Customer::where('id', $id)->first();
    return $data;
  }
  public function get_district($state)
  {

    $district = State::where('state', $state)->get();
    return $district;
  }
}
