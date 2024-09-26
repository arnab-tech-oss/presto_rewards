<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $id = auth('sanctum')->user()->id;

        $customer = Customer::with('appsetting')->where('id',$id)->get();

        return response()->json(responseData($customer,"Dashboard"));
    }
}
