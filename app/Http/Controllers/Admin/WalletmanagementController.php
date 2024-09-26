<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Yajra\DataTables\DataTables;

class WalletmanagementController extends Controller
{
  public $page = 'wallet';
  public $page1 = 'transaction';

  public function walletlist(Request $request)
  {
    if ($request->ajax()) {
      $data = Wallet::with('walletlist')->latest('created_at');
      return datatables::of($data)
          ->addIndexColumn()
          ->addColumn('status', function ($row) {
            $status = "<span class='badge bg-warning'>PENDING</span>";
                    if ($row->status == 'active') {
                        $status = "<span class='badge bg-success'>Active</span>";
                    } else if ($row->status == 'inactive') {
                        $status = "<span class='badge bg-danger'>Inactive</span>";
                    }
                    return $status;
          })
          ->addColumn('action', function ($row) {
              $actionBtn = view('admin.walletmanagemeny.button', ['item' => $row, 'page' => $this->page]);
              return $actionBtn;
          })
          ->rawColumns(['status','action'])
          ->make(true);
  }
  return view('admin.walletmanagemeny.walletlist');
  }

  public function walletstatus($id)
  {
    $user_id = auth()->user()->id;
    $wallet = Wallet::where('customer_id', $id)->first();

    if ($wallet->status == "inactive") {
      $wallet->status = "active";
      $wallet->updated_by = $user_id;
      $wallet->save();
      if ($wallet->save()); {
        return redirect()->route('admin.walletmanagement.list');
      }
    } else {

      $wallet->status = "inactive";
      $wallet->updated_by = $user_id;
      $wallet->save();
      if ($wallet->save()); {
        return redirect()->route('admin.walletmanagement.list');
      }
    }
  }
  public function transactionview(Request $request,$id)
  {
    $cus_id = $id;
    $data = WalletTransaction::with('wallet.customer')->where('wallet_id', $id)->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.walletmanagemeny.button', ['item' => $row, 'page' => $this->page1]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    //$trans = WalletTransaction::where('wallet_id', $id)->get();
    return view('admin.walletmanagemeny.transaction', compact('cus_id'));
  }
  public function alltrancaction(Request $request)
  {
    $data = WalletTransaction::with('wallet.customer')->get();
        if ($request->ajax()) {
          
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                  $actionBtn = view('admin.walletmanagemeny.button_all', ['item' => $row, 'page' => $this->page]);
                  return $actionBtn;
              })
                ->rawColumns(['action'])
                ->make(true);
              }
    // $alltrans = WalletTransaction::all();
    return view('admin.walletmanagemeny.alltransaction',compact('data'));

  }

  public function viewtrancaction(Request $request ,$id)
  {
    $data =  WalletTransaction::where('id', $id)->with('wallet.customer')->first();
   // return $data;
    return view('admin.walletmanagemeny.view_wallate_transection', compact('data'));
  }

}

