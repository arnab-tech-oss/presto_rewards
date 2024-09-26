<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function customerlogin()
    {
        return view('admin.login');
    }

    public function postlogin(Request $request)
    {
    $request->validate([
        'email_id' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email_id)->first();

    if (!$user) {
        return redirect()->back()->with('email_message', 'User invalid');
    }

    $credentials = [
        'email' => $request->email_id,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        return redirect()->route('admin.dashboard')->with('success','You are Successfully Loggedin');
    } else {
        return redirect()->back()->with('password_message', 'Please Provide Correct Password');
    }
    }

    public function adminlogout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('admin.login')->with('message','You are Successfully Logout');
    }

    public function forgotpassword()
    {
        return view('admin.forgetpassword');
    }

    public function passwordforget(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
              ]);

              $maildata= [

                'title' => 'Token Generate Successfully',
                'body' => 'This token is use for change password.'
            ];

            Mail::to($request->email)->send(new ForgotPassword($maildata, $token));

            return redirect()->route('admin.login');
        }
    }

    public function showResetPasswordForm($token)
    {
        return view('admin.resetpassword',['token' => $token]);
    }
    public function new_password(Request $request){

        $validator = Validator::make([
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
    }else{
       $check =  DB::table('password_resets')->where('token' , $request->token)->first();
        $user = User::where('email' , $check->email)->first();
       $user->update([
        'password' => Hash::make($request->password),
       ]);

    }

}
}
