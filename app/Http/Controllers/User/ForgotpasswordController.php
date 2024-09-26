<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\SentOtpMessage;
use App\Models\Customer;
use App\Models\Otp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotpasswordController extends Controller
{
    //
    public function getotp(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone_number',
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        }

        $mobile = $request->phone;
        $id = Customer::where('phone_number', $request->phone)->first();
        $otp_details = Otp::where('cus_id', $id->id)->first();
        if ($otp_details) {
            $otp_details->update([
                'updated_at' => Carbon::now(),
            ]);
            $otp = $otp_details->otp;
        } else {
            $otp = rand(1111, 9999);
            $data = Otp::create([
                'cus_id' => $id->id,
                'otp' => $otp,
                'updated_at' => Carbon::now(),
            ]);
        }
        $message = "Welcome to Presto Plast India Rewards App! Your OTP for profile verification is  $otp . Please enter it to complete your registration. Thank you!";

        $responseData = event(new SentOtpMessage($message, $mobile));
        $data1 = [
            'otp' => $otp,
            'phone' => $request->phone,
        ];
        if (isset($responseData[0]['status']) && $responseData[0]['status'] == 'success' && strval($responseData[0]['statusCode']) == '200') {
            return response()->json(responseData($data1, "otp send successfull"));
        } else {
            return response()->json(responseData(null, "otp send failed", false));
        }
    }

    public function varifyotp(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone_number',
            'otp' => 'required'
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        }

        $cus = Customer::where('phone_number', $request->phone)->first();
        $opt_details = Otp::where('id', $cus->id)->first();
        if ($opt_details && $opt_details->otp == $request->otp) {
            $opt_details->delete();
            return response()->json(responseData(null, "otp varified"));
        } else {
            return response()->json(responseData(null, "otp Not varified", false));
        }
    }

    public function password_update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone_number',
            'password' => 'required'
        ]);
        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        }

        $cus = Customer::where('phone_number', $request->phone)->first();
        if ($cus) {
            $cus->update([
                'password' => Hash::make($request->password),
                'passcode' => $request->passcode,
            ]);

            return response()->json(responseData(null, "password reset successfully"));
        } else {
            return response()->json(responseData(null, "something went wrong", false));
        }
    }
}
