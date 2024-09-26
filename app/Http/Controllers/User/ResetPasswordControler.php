<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordControler extends Controller
{
    public function resetpasscode(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $validate = Validator::make($request->all(), [
            'old_passcode' => 'required',
            'new_passcode' => 'required|different:old_passcode',
            'conf_passcode' => 'required|same:new_passcode'
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            $data = Customer::where('id', $id)->first();
            if ($data->passcode == $request->old_passcode) {
                $data->update([
                    'passcode' => $request->new_passcode,
                ]);
                return response()->json(responseData(null, "your passcode update successfully"));
            } else {
                return response()->json(responseData(null, "please provide correct passcode", false));
            }
        }
    }

    public function resetpassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|exists:customers,email_id',
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return response()->json(responseData(null, $message, false));
        } else {
            return response()->json(responseData(null,"reset password link sent to your maid id"));
        }
    }

    public function passcode(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $validate = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone_number',
            'passcode' => 'required',
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return response()->json(responseData(null, $message, false));
        }else {
            // Assuming 'phone_number' is the column name in the customers table
            $data = Customer::where('id', $id)->first();
    
            if ($data) {
                // Update the 'passcode' field
                $data->passcode = $request->input('passcode');
                $data->save();
    
                // If you want to fetch the updated data, you can do so
                $updatedData = Customer::find($id);
    
                return response()->json(responseData($updatedData, 'Passcode updated successfully', true));
            } else {
                return response()->json(responseData(null, 'Customer not found', false));
            }
        }
    }
}
