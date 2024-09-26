<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\SettingsPages;
use Illuminate\Support\Facades\Validator;
class PagesController extends Controller
{
//     public function page()
// {
//      return view ('admin.setting.pages');
// }
public function showpage()
{
   
    return view('admin.setting.addpages',);
}
public function addpage(Request $request)
{
    $validator = Validator::make($request->all(),[
       
        'tittle' => 'required',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }else{
    $entity= new SettingsPages();
    $entity->tittle= $request->tittle;
    $entity->description = $request->description;
    $entity->save();
    return redirect()->route('admin.setting.showdata')->with('success','page added successfully');
}
}

     public $page = 'Company';
     public function  showdata(Request $request)
     {
        //$showdatas =  SettingsPages::all();
        //return view('admin.setting.pages',compact('showdatas'));
        if ($request->ajax()) {
            $data = SettingsPages::latest('created_at');
            return datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     $checked = $row->status == 'active' ? 'checked' : '';

                //     return '<div class="form-check form-switch form-switch-md mb-2">
                //     <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('page.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                //                 <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                //             </div>';
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.setting.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->addColumn('description', function ($row) {
                    $actionBtn = view('admin.setting.description', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action','description'])
                ->make(true);
        }
        return view('admin.setting.pages');


     }
     public function edit($id)
     {
       
        $edit= SettingsPages::where('id',$id)->first();
        return view('admin.setting.editpage',compact('edit'));
     }
     public function update(Request $request)
     {
         $id=$request->id;
         $update=SettingsPages::where('id',$id)->first();
         $update->tittle= $request->tittle;
         $update->description= $request->description;  
         $update->update($update->toarray());
         return redirect()->route('admin.setting.showdata')->with('message','product update successfully');
     }

     public function status($id)
     {
         $status = SettingsPages::where('id', $id)->first();
 
         if ($status->status == "active") {
            SettingsPages::where('id', $id)->update(['status' => 'inactive']);
             return "InActive";
         } else {
            SettingsPages::where('id', $id)->update(['status' => 'active']);
             return "Active";
         }
     }

     function deletepage ($id)
     {
         $data = SettingsPages::where('id', $id)->first();
 
         if (!$data) {
             return response()->json(['error' => 'Record not found'], 404);
         }
         else
         {
             $data->delete();
             return response()->json(['message' => 'Record delete successfully']);
         }
     }
}
