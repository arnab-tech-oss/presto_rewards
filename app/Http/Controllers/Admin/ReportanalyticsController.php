<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CouponRequest;
use Illuminate\Support\Carbon;
use App\Models\RedemptionRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Yajra\DataTables\Facades\DataTables;

class ReportanalyticsController extends Controller
{
     public function reportlist(Request $request)
    {
        // $pdcr=RedemptionRequest::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        //     ->groupBy('date')
        //     ->get();

        // $pmcr=RedemptionRequest::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        // ->groupBy('month')
        // ->get();

        $data = CustomerAddress::with('customer')->get();
    
      return view('admin.reportanalyticsmanagement.report',compact('data'));

    }

    public function bulkemail()
    {
      
        return view('admin.reportanalyticsmanagement.bulkemail', );
    }

    public function customerlist($id)
    {
        $data = CustomerAddress::with('customer')->where('state_id',$id)->get();

        return view ('admin.reportanalyticsmanagement.report',compact('data'));
    }
}
