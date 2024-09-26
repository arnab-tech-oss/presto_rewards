<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function state()
    {
        $data = State::distinct()->get(['state']);
        return response()->json(responseData($data,"Successfully state retrive"));
    }

    public function district(Request $request)
    {
        $data = state::where('state',$request->state)->get();
        return response()->json(responseData($data,"District retrive successfully"));
    }
}
