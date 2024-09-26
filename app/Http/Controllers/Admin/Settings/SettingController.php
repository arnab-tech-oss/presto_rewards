<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\BaseController;


class SettingController extends Controller
{
    public function index()
    {
        
//dd($x[1]->billing_footer1);
        $setting = Setting::first();
        return view('admin.setting.setting',compact('setting'));
    }

    public function store(Request $request)
    {
       

        if($request->id == null)
        {
            $setting = new Setting();
        }else{
            $setting = Setting::find($request->id);
        }
        //dd($setting);
        $fileName= '';
         if ( !is_dir( public_path("images/setting") ) ) {
            mkdir(  public_path("images/setting") );       
        } 
        if($request->hasFile('company_logo')) {
            if(file_exists(public_path('images/setting/logo-sm.png'))){
                unlink(public_path('images/setting/logo-sm.png'));
                }
            $logoFile = $request->file('company_logo');
            $imageName = 'logo-sm.'.$request->company_logo->extension();
            $request->company_logo->move(public_path('images/setting'), $imageName);
            $fullPath = 'images/setting/' . $imageName;
            $setting->company_logo = $fullPath;
        }
        $setting->user_id = Auth::user()->id;
        $setting->software_title = $request->software_title;
        $setting->software_description = $request->software_description;
        $setting->software_version = $request->software_version;
        $setting->company_name = $request->company_name;
        //$setting->company_logo = $fileName;
        $setting->company_intro = $request->company_intro;
        $setting->company_email = $request->company_email;
        $setting->company_alternative_email = $request->company_alternative_email;
        $setting->company_contact_no = $request->company_contact_no;
        $setting->company_alternative_contact_no = $request->company_alternative_contact_no;
        $setting->company_gst_no = $request->company_gst_no;
        $setting->billing_header = $request->billing_header;
        $setting->billing_footer = $request->billing_footer;
        $setting->billing_footer1 = $request->billing_footer1;
        $setting->email_cc = $request->email_cc;
        $setting->email_bcc = $request->email_bcc;
        //$setting->account_email = $request->account_email;
        //$setting->api_key = $request->api_key;
        $setting->save();

        if($setting){
            Session::flash('message', "Settings data are updated successfully.");
            Session::flash('alert-class', 'alert-success');
        }else{
            Session::flash('message', "Something is wrong to update settings data.");
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('admin.setting.index');
    }
}
