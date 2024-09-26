<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Models\Qr;
use App\Models\Coupon;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CouponRequest;
use Barryvdh\DomPDF\Facade\PDF;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public $page = 'Coupon';
    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Coupon::with('couponRequest.company')->where('coupon_request_id', $id);
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.companymanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.couponmanagement.couponindex', compact('id'));
    }



    public function serachproduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Coupon::with('couponRequest.company')->where('id', $id)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
            //return;
        return view('admin.couponmanagement.universalcouponsearch');
    }
}
