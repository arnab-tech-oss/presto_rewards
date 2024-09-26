<?php

namespace App\Http\Controllers;


use App\Models\Payout;
use Illuminate\Http\Request;
use App\Models\PayoutTransaction;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Yajra\DataTables\DataTables;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PayoutController extends Controller
{
    public $page = 'transaction';
    public function payout(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');

            // Fetch the data from the database
            if ($status != '') {
                if ($status && in_array($status, ['PENDING', 'COMPLETED', 'FAILED', 'INITIATED'])) {
                    $data = Payout::with('transaction', 'customer')->get();
                    $data = $data->filter(function ($item) use ($status) {
                        return $item->status == $status;
                    });
                }

            } else {
                $data = Payout::with('transaction', 'customer')->get();
            }

            if ($request->filled('from_date') && $request->filled('end_date')){
                $data = $data->whereBetween('created_at', [$request->from_date, $request->end_date]);
            }

            return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = view('admin.payout.button1', ['item' => $row, 'page' => $this->page]);
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.payout.index');
    }

    // public function update(Request $request)
    // {
    //     $payout =Payout::where('status',$request->status)->get();
    //     $data = $request->status;
    //     // $payout=Payout::where('status','reject')->where('id',$id)->get();
    //     return view('admin.payout.index',compact('payout','data'));
    // }
    public function transaction(Request $request)
    {
        if ($request->ajax()) {
            $data = PayoutTransaction::with('payout.customer')->get();
            return datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($model) {
                    if ($model->status == 'success') {
                        $formatData = '<button class="btn btn-sm btn-success">SUCCESS</button>';
                    } else if ($model->status == 'pending') {
                        $formatData = '<button class="btn btn-sm btn-warning">PENDING</button>';
                    } else if ($model->status == 'rejected') {
                        $formatData = '<button class="btn btn-sm btn-danger">FAILED</button>';
                    } else {
                        $formatData = '<button class="btn btn-sm btn-danger">' . ucfirst($model->status) . '</button>';
                    }

                    return new HtmlString($formatData);
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.payout.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // $transaction= PayoutTransaction::all();
        return view('admin.payout.transaction');
    }

    public function document($id)
    {
        $data = Payout::with('transaction', 'customer.address')->where('id', $id)->first();
        $wallet_id = Wallet::where('customer_id', $data->customer->id)->first();
        return view('admin.payout.payoutpdf', compact('data', 'wallet_id'));
    }

    public function view($id)
    {
        $data = Payout::with('transaction', 'customer.address')->where('id', $id)->first();
        $wallet_id = Wallet::where('customer_id', $data->customer->id)->first();
        return view('admin.payout.view', compact('data', 'wallet_id'));
    }

    public function payout_pdf($id)
    {
        $data = Payout::with('transaction', 'customer.address')->where('id', $id)->first();
        $wallet_id = Wallet::where('customer_id', $data->customer->id)->first();
        return view('admin.payout.payoutpdf', compact('data', 'wallet_id'));
    }
}
