<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Payout;

class NotificationController extends Controller
{
    public function index()
    {
        $id = auth('sanctum')->user()->id;
        $data = Notification::where('customer_id', $id)->get();
        if ($data) {
            return response()->json(responseData($data, "notification retrive successfully"));
        } else {
            return response()->json(responseData(null, "no notification available", false));
        }
    }

    public function addnotification(Request $request)
    {
        $data = validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($data->fails()) {
            return response()->json(responseData(null, $data->errors(), false));
        } else {
            $id = auth('sanctum')->user()->id;
            $timestamp = Carbon::now();

            $entity = new Notification();
            $entity->customer_id = $id;
            $entity->message = $request->message;
            $entity->date_time = $timestamp;

            $entity->save();

            if ($entity->save()) {
                return response()->json(responseData(null, "successfull", true));
            } else {
                return response()->json(responseData(null, "faild", false));
            }
        }
    }

    public function readnotification(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(responseData(null, $validate->errors(), false));
        } else {
            $data = Notification::where('id', $request->id)->first();
            $data->is_read = "read";
            $data->save();
        }
        if ($data->save()) {
            return response()->json(responseData(null, "successfull", true));
        }
    }
    public function delete(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $notification_id = $request->notification_id;
        if ($notification_id) {
            $data = Notification::where('id', $notification_id)->where('customer_id', $id)->delete();
        }else{
            $data = Notification::where('customer_id', $id)->delete();
        }

        return response()->json(responseData(null,'delete successfull'));
    }
}
