<?php

use App\Models\Customer;
use Illuminate\Support\Carbon;
use App\Models\CouponRequest;
use App\Models\Coupon;
use App\Models\SettingsPages;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Setting;
function responseData($data, $message = "",$status=true,)
{
    return [
        "success" => $status,
        "message" => $message,
        "data" => $data
    ];
}

function quickreport()
{
    $customer = Customer::get()->count();
    $new_customer = Customer::whereBetween('created_at', [Carbon::now()->startofweek(), now()->endofweek()])->get()->count();
    $generated_coupon = CouponRequest::get()->count();
    $total_redeemed = Coupon::where('status','used')->get()->count();
    //$coupon_code = $total_redeemed->coupon_code;
    return [
        'customer' => $customer,
        'new_customer' => $new_customer,
        'generated_coupon' => $generated_coupon,
        'total_redeemed'  =>  $total_redeemed,
    ];
}
  function search(Request $request)
  {
    $search=$request['search'] ?? "";
    if($search!=""){
       $customer=Customer::where('first_name','Like','%$search%')->get();
    }else{
        $customer=Customer::all();
    }
    return [
        'customer' => $customer,
        'search'=> $search,
    ];
  }
function notification()
{
    $notifi=Notification::where('is_read','unread')->get()->count();

    return ['notifi'=>$notifi];
}

function notify()
{
    $notimess=Notification::where('is_read','unread')->latest()->get();

    // return view('admin.layout.header',compact('notimess'));
    return $notimess;
}

function appsetting()
{
    $appset=Setting::all();
    // return view('admin.layout.header',compact('$notimess'));
    return ['appset'=>$appset];
}
     function index(Request $request)
    {
        if($request->has('search')){
            $trains = Product::search($request->search)
                ->paginate(6);
        }else{
            $trains = Product::paginate(6);
        }
        return ['trains'=>$trains];
    }
     function app_user()
    {
        $customer = Customer::where('created_by', null)->get()->count();
        return $customer;
    }

    function footer_content()
    {
        $data = SettingsPages::select('tittle','description')->distinct()->get();
        return  $data;
    }
