<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    // public function showtranaction($id)
    // {
    //     $trancactions= WalletTransaction::all();
    //     return view('admin.walletmanagemeny.transaction',compact('trancactions'));
    // }


    // public function transaction($id)
    // {
    //     $trans = Wallet::with('transaction')->where('customer_id', $id)->latest()->get();
    //     return view ('admin.customermanagement.transaction',compact('trans'));
    // }

    public function transaction(Request $request, $id)
    {
        $cus_id = $id;
        if ($request->ajax()) {
            $data = Wallet::with('transaction')->where('customer_id', $id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('amount', function ($data) {
                    $amounts = [];

                    foreach ($data->transaction as $transaction) {
                        $amounts[] = $transaction->amount;
                    }

                    return implode('<br>', $amounts);
                })
                ->rawColumns (['amount'])
                ->make(true);
        }
        return view('admin.customermanagement.transaction', compact('cus_id'));
    }
}
