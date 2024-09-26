<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\RedemptionRequest;
use App\Models\PayoutTransaction;

class DashboardController extends Controller
{
    public $report = "Total";
    public function dashboard()
    {
        $app_user_total = Customer::where('created_by', null)->get()->count();
        $app_user_present_month = Customer::where('created_by', null)->wheremonth('created_at',Carbon::now()->month)->count();
        $app_user_last_7_days = Customer::where('created_by', null)->where('created_at','>=',Carbon::now()->subdays(7))->count();

        $redeempt_pending_total = RedemptionRequest::where('status','pending')->get()->count();
        $redeempt_amount = RedemptionRequest::where('status','pending')->sum('amount');

        $payout_total = PayoutTransaction::sum('amount');
        $payout_count = PayoutTransaction::where('amount', !null)->get()->count();
        $payout_last_month = PayoutTransaction::wheremonth('created_at',Carbon::now()->month)->count();
        $payout_this_month = PayoutTransaction::wheremonth('created_at',Carbon::now()->month)->count();
        $payout_last_7_days = PayoutTransaction::where('created_at','>=',Carbon::now()->subdays(7))->count();
        $report = $this->report;
        return view('admin.dashboard',compact('app_user_total','app_user_present_month','app_user_last_7_days','redeempt_pending_total','redeempt_amount','payout_total','payout_last_month','payout_this_month','payout_last_7_days','report','payout_count'));
    }

    //     public function index(Request $request)
    //     {
    //         $search = $request['searchQuery'] ?? "";

    //         if ($search != "") {
    //             $customer = Product::where('product_name', 'LIKE', "%$search%")->get();
    //         } else {
    //             $customer = null;
    //         }

    //     return [
    //         'customer' => $customer,
    //         'search' => $search,
    //     ];
    // }

    function notification_status()
    {
        $read = Notification::where('is_read', 'unread')->get();
        if ($read) {
            Notification::where('is_read', 'unread')->update(['is_read' => 'read']);
            return "read";
        }
    }

    public $page = 'Notification';
    public function  showdata(Request $request)
    {
        $id = auth()->user()->id;
        //return $id;
        if ($request->ajax()) {
            $data = Notification::with('notifi')->orderByDesc('created_at')->get();
            return datatables::of($data)
                ->addIndexColumn()
                //   ->addColumn('status', function ($row) {
                //     $checked = $row->status == 'active' ? 'checked' : '';
                //     return '<div class="form-check form-switch form-switch-md mb-2">
                //                 <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('product.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                //                 <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                //             </div>';
                //   })
                //   ->addColumn('action', function ($row) {
                //     $actionBtn = view('admin.productmanagement.button', ['item' => $row, 'page' => $this->page]);
                //     return $actionBtn;
                //   })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.layout.notification');
    }
    public function app_user()
    {
        $customer = Customer::where('created_by', null)->get()->count();
        return view('admin.dashboard', compact('customer'));
    }
}
