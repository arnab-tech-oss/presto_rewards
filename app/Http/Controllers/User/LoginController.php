<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ProductCatalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class LoginController extends Controller
{
    public function customerlogin(Request $request)
    {


        $validation = Validator::make($request->all(), [
            'phone' => 'required|numeric',
            'password' => 'required_without:passcode',
            'passcode' => 'required_without:password',
        ]);

        if ($validation->fails()) {
            return response()->json(responseData($validation->errors(), "Validation error", false));
        }else{
            $cutstomer =  Customer::where("phone_number", $request->phone)->where('status','active')->first();
        }

        //$cutstomer =  Customer::where("phone_number", $request->phone)->first();

        if (!$cutstomer) {
            return response()->json(responseData("", "Record not matched with our records", false));
        }
    
        
        if (Hash::check($request->password, $cutstomer->password) || ($request->passcode === $cutstomer->passcode)) {
            $token = $cutstomer->createToken('Myapp')->plainTextToken;

            //$cutstomer->token = $token;
            $data = Customer::select('id','first_name','last_name','phone_number')->where('phone_number', $request->phone)->first();
            $data->update([
                'last_login' => Carbon::now()->format('d-m-Y H:i'),
            ]);
            $data['token'] = $token;

            return response()->json(responseData($data,"Login Successfully"));
        }else{
            return response()->json(responseData("", "Credential not match", false));

        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json(responseData(null,"logout successfully"));
    }
}
