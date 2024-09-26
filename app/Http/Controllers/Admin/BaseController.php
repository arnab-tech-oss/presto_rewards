<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
  // public static $customer;
  // public static $new_customer;
    public function user()
    {
        // $id = Auth::user()->id;
        // $user = User::where('id',$id)->first();
        $setting = Setting::first();
        return [$setting];
    }

      // public function  customer()
      // {
      //   // $total_customer= Customer::whereBetween('created_at', [Carbon::now()->startofweek(), now()->endofweek()])->limit(1)->get()->count();
      //   // $total_customer  =  $customer->count();
      //     // $total_customer= Customer::select('id', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as created_on'))->get()->count();
      //   $total_customer= Customer::get()->count();
      //    return $total_customer;
      // }


      // public function newcustomer()
      // {
      //   $new_customer=Customer::whereBetween('created_at', [Carbon::now()->startofweek(), now()->endofweek()])->get()->count();
      //   return $new_customer;
      // }



      // public function __construct()
      // {
      //   $this->customer = Customer::get()->count();
      //   $this->new_customer = Customer::whereBetween('created_at', [Carbon::now()->startofweek(), now()->endofweek()])->get()->count();
      // }
    
}


