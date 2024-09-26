<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
class MarketingController extends Controller
{
  public function marketingtool()
  {
    
    return view('admin.marketingmanagement.marketingtools', );
  }
}
