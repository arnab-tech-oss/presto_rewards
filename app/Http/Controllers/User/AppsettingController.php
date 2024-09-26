<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppsettingController extends Controller
{
    public function appsetting(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            //'mobile_id' => 'required',
            'whatsapp_availability' => 'numeric',
            'app_version' => 'required',
            'language' => 'required',
            'notification_setting' => 'required',
            'location_setting' => 'required',
            'theme_preference' => 'required',
            'apptour_status' => 'required',
            'preffered_currancy' => 'required',
            'biometric_auth' => 'required',
            'mpin_auth' => 'required',
        ]);

        if ($validateData->fails()) {
            $message = $validateData->errors();
            return response()->json(responseData(null, $message, false));
        } else {

            $id = auth('sanctum')->user()->id;

            $timestamp = now()->format('YYYY-MM-DD H:i:s');

            $data = $request->all();
            $data['last_login'] = $timestamp;
            $data['customer_id'] = $id;
            unset($data['mobile_id']);

            $save = AppSetting::create($data);

            if ($save) {
                return response()->json(responseData(null, "Data Inserted successfully"));
            } else {
                return response()->json(responseData(null, "Customer not found", false));
            }
        }
    }

    public function updateappsetting(Request $request)
    {
        $timestamp = now()->format('YYYY-MM-DD H:i:s');
        $id = auth('sanctum')->user()->id;
        $appsetting = AppSetting::where('customer_id', $id)->first();
        if ($appsetting) {
            $data = $request->all();
            $data['last_login'] = $timestamp;
            unset($data['mobile_id']);
            $appsetting->update($data);
            return response()->json(responseData(null, "Update Successfully"));
        } else {
            return response()->json(responseData(null, "invalid credential", false));
        }
    }

    // public function information()
    // {
    //     $id = auth('sanctum')->user()->id;
    //     $data = AppSetting::where('customer_id',$id)->get();
    //     return $data;
    // }
}
