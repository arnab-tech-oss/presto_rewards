<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppurlController extends Controller
{
    public function appurl()
    {
        return view('admin.appurl.playstore');
    }
}
