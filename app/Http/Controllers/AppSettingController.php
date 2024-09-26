<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SettingApp;
use App\Models\ApiKey;
use App\Models\Role;
use App\Models\UserType;
use App\Models\CompanyInfo;
use App\Models\Media_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AppSettingController extends Controller
{
    public function appsetting()
    {
        $app_setting = SettingApp::first();
        return view('admin.setting.appsetting', compact('app_setting'));
    }
    public function create(Request $request)
    {
        if ($request->id == null) {
            $app_setting = new SettingApp();
        } else {
            $app_setting = SettingApp::find($request->id);
        }

        $fullPath = null;
        $dark_logo = null;
        $fav_icon = null;

        $validator = Validator::make($request->all(), [
            'app_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'dark_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'fab_icon' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes()) {
                if ($request->hasFile('app_logo')) {
                    $imageName = time() . '.' . $request->file('app_logo')->extension();
                    $request->app_logo->move(public_path('images/company'), $imageName);
                    $fullPath = 'images/company/' . $imageName;
                }

                if ($request->hasFile('dark_logo')) {
                    $dark_logo = 'abfjiheruueru' . '.' . $request->file('dark_logo')->extension();
                    $request->dark_logo->move(public_path('images/company'), $dark_logo);
                    $dark_logo = 'images/company/' . $dark_logo;
                }

                if ($request->hasFile('fab_icon')) {
                    $fav_icon = 'kjjjjrhquyqq4r34r' . '.' . $request->file('fab_icon')->extension();
                    $request->fab_icon->move(public_path('images/company'), $fav_icon);
                    $fav_icon = 'images/company/' . $fav_icon;
                }
            }

            $app_setting->title = $request->app_title;
            $app_setting->description = $request->app_description;
            $app_setting->version = $request->app_version;
            $app_setting->beta_url = $request->beta_url;
            $app_setting->playstore_url = $request->playstore_url;
            $app_setting->appstore_url = $request->appstore_url;
            $app_setting->header = $request->billing_header;
            $app_setting->footer_left = $request->billing_footer;
            $app_setting->footer_right = $request->billing_footer1;
            $app_setting->cc = $request->email_cc;
            $app_setting->Bcc = $request->email_bcc;
            if ($dark_logo != null) {
                $app_setting->dark_logo = $dark_logo;
            }
            if ($fav_icon != null) {
                $app_setting->favicon_logo = $fav_icon;
            }
            if ($fullPath != null) {
                $app_setting->applogo = $fullPath;
            }
            $app_setting->save();

            if ($app_setting) {
                Session::flash('message', "Settings data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();
        }
    }

    public function company()
    {
        $c_info = CompanyInfo::first();
        return view('admin.setting.company_info', compact('c_info'));
    }

    public function insert(Request $request)
    {

        if ($request->id == null) {
            $c_info = new CompanyInfo();
        } else {
            $c_info = CompanyInfo::find($request->id);
        }

        $validator = Validator::make($request->all(), [
            // 'c_logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            // 'gst' => 'required|numeric|digits:15',
        ]);
        // return $c_info;
        $fullPath = null;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes()) {
                if ($request->hasFile('c_logo')) {
                    $imageName = time() . '.' . $request->file('c_logo')->extension();
                    $request->c_logo->move(public_path('images/company'), $imageName);
                    $fullPath = 'images/company/' . $imageName;
                }
            }

            $c_info->company_name = $request->c_name;
            $c_info->address = $request->c_address;
            $c_info->city = $request->city;
            $c_info->state = $request->state;
            $c_info->country_name = $request->country_name;
            $c_info->whats_app_no = $request->wp_no;
            $c_info->phone = $request->phone;
            $c_info->email = $request->email;
            $c_info->gst_number = $request->gst;
            $c_info->company_header = $request->header;

            if ($fullPath != null) {
                $c_info->company_logo = $fullPath;
            }
            $c_info->save();

            if ($c_info) {
                Session::flash('message', "Company data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();
        }
    }

    public function finance()
    {
        return view('admin.setting.finance');
    }

    public function appkey()
    {
        $api_setting = ApiKey::first();
        return view('admin.setting.app_keys', compact('api_setting'));
    }

    public function store(Request $request)
    {
        if ($request->id == null) {
            $api_setting = new ApiKey();
        } else {
            $api_setting = ApiKey::find($request->id);
        }

        $api_setting->api_key = $request->s_key;
        $api_setting->google_key = $request->google_key;

        $api_setting->save();

        if ($api_setting) {
            Session::flash('message', "Company data are updated successfully.");
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', "Something is wrong to update settings data.");
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->back();
    }

    public function view()
    {
        $roles = Role::with('usertype')->get();
        return view('admin.setting.miscellaneous', compact('roles'));
    }

    public function add(Request $request)
    {
        // Get all data from the UserType table
        $userTypes = UserType::get();

        // Get the "usr_type" array from the request
        $requestUserTypes = $request->input('usr_type');

        // Loop through all data from UserType
        foreach ($userTypes as $userType) {
            // Check if the current UserType exists in the request data
            if (in_array($userType->roll_id, $requestUserTypes)) {
                // Match found, skip this item
                continue;
            } else {
                // No match found, delete this item
                $userType->delete();
            }
        }

        // Loop through the request data
        foreach ($requestUserTypes as $requestUserType) {
            // Check if the current request data exists in UserType
            if (!$userTypes->contains('roll_id', $requestUserType)) {
                // No match found, add this item
                UserType::create(['roll_id' => $requestUserType]);
            }
        }

        // Additional code after processing the data
        return redirect()->route('admin.app.miscellaneous');
    }

    public function media()
    {
        $app_media = Media_file::first();
        return view('admin.setting.media', compact('app_media'));
    }

    public function post_media(Request $request)
    {
        if ($request->id == null) {
            $app_media = new Media_file();
        } else {
            $app_media = Media_file::find($request->id);
        }

        $fullPath = null;
        $media2 = null;
        $media3 = null;
        $media4 = null;

        $validator = Validator::make($request->all(), [
            'media_1' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'media_2' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'media_3' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'media_4' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes()) {
                if ($request->hasFile('media_1')) {
                    $media1 = time() . '.' . $request->file('media_1')->extension();
                    $request->media_1->move(public_path('images/company'), $media1);
                    $fullPath = 'images/company/' . $media1;
                }

                if ($request->hasFile('media_2')) {
                    $media2 = 'prestomedia12713' . '.' . $request->file('media_2')->extension();
                    $request->media_2->move(public_path('images/company'), $media2);
                    $media2 = 'images/company/' . $media2;
                }

                if ($request->hasFile('media_3')) {
                    $media3 = 'prestomedia45678' . '.' . $request->file('media_3')->extension();
                    $request->media_3->move(public_path('images/company'), $media3);
                    $media3 = 'images/company/' . $media3;
                }

                if ($request->hasFile('media_4')) {
                    $media4 = 'prestomedia753159741' . '.' . $request->file('media_4')->extension();
                    $request->media_4->move(public_path('images/company'), $media4);
                    $media4 = 'images/company/' . $media4;
                }
            }


            if ($media3 != null) {
                $app_media->media_3 = $media3;
            }
            if ($media2 != null) {
                $app_media->media_2 = $media2;
            }
            if ($fullPath != null) {
                $app_media->media_1 = $fullPath;
            }
            if ($media4 != null) {
                $app_media->slider_4 = $media4;
            }
            $app_media->save();

            if ($app_media) {
                Session::flash('message', "Settings data are updated successfully.");
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', "Something is wrong to update settings data.");
                Session::flash('alert-class', 'alert-danger');
            }

            return redirect()->back();
        }
    }
}
