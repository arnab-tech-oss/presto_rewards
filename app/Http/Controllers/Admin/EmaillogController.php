<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmaillogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailLog::get();
            return datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($row) {
                $actionBtn = view('admin.emaillog.button', ['item' => $row]);
                return $actionBtn;
              })
              ->rawColumns(['action'])
              ->make(true);
          }
        return view ('admin.emaillog.index');
    }

    public function view($id)
    {
        $data = EmailLog::where('id',$id)->first();
        return view ('admin.emaillog.view',compact('data'));
    }
}
