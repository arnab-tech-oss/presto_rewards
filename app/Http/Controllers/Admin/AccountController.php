<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
class AccountController extends Controller
{
    public function index()
    {
      
        return view('admin.Accounts.paymentindex', );
    }

    public function transaction()
    {
      
        return view('admin.Accounts.transaction', );
    }
}
