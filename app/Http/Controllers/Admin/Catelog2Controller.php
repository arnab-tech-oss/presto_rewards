<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelog2;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class Catelog2Controller extends Controller
{
    public $page = "Category";
    public function index(Request $request)
    {
        $page = $this->page;
        if ($request->ajax()) {
            $data = Catelog2::latest('created_at');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch form-switch-md mb-2">
              <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('catalog.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                          <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                      </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.catelog2.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.catelog2.index', compact('page'));
    }

    public function add()
    {
        $page = $this->page;
        return view('admin.catelog2.add', compact('page'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf',
            'name' => 'required|unique:catalogs,name',
            'cover_file' => 'required|file|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $id = auth()->id();
            $fullPath = null;
            $coverpath = null;
            if ($request->hasFile('file')) {
                $imageName = time() . '.' . $request->file('file')->extension();
                $request->file->move(public_path('images/catalog'), $imageName);
                $fullPath = 'images/catalog/' . $imageName;
            }
            if ($request->hasFile('cover_file')) {
                $imageName = time() . '.' . $request->file('cover_file')->extension();
                $request->cover_file->move(public_path('images/catalog'), $imageName);
                $coverpath = 'images/catalog/' . $imageName;
            }
            $catalog = new Catelog2();
            $catalog->name = $request->name;
            $catalog->description = $request->description;
            $catalog->image = $fullPath;
            $catalog->cover_picture = $coverpath;
            $catalog->status = 'active';
            $catalog->created_by = $id;
            $catalog->save();

            return redirect()->route('admin.catalog')->with('success','Catalog created Successfully');
        }

        return $request->all();
    }

    public function catalogstatus($id)
    {

        $user_id = auth()->id();
        $status = Catelog2::where('id', $id)->first();

        if ($status->status == "active") {
            Catelog2::where('id', $id)
                ->update(['status' => 'inactive', 'updated_by' => $user_id]);
            return "InActive";
        } else {
            Catelog2::where('id', $id)
                ->update(['status' => 'active', 'updated_by' => $user_id]);
            return "Active";
        }
    }

    public function viewcatalog($id)
    {
        $viewcatalog = Catelog2::where('id', $id)->first();
        return view('admin.catelog2.viewcatalog', compact('viewcatalog'));
    }

    public function catalogedit($id)
    {

        $catalogedit = Catelog2::where('id', $id)->first();
        return view('admin.catelog2.catalogedit', compact('catalogedit'));
    }

    public function catalogupdate(Request $request, $id)
    {
        $imageName = null;
        $validator = Validator::make($request->all(), [
            'file' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes() && $request->hasFile('file')) {
                $imageName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('images/catalog'), $imageName);
            }
            $fullPath = 'images/catalog/' . $imageName;

            $catalog_update = Catelog2::where('id', $id)->first();
            $catalog_update->name = $request->name;
            $catalog_update->description = $request->description;
            if ($imageName !== null) {
                $catalog_update->image = $fullPath;
            }
            $catalog_update->update($catalog_update->toarray());
            return redirect()->route('admin.catalog')->with('update_success','Category update successfully');
        }
    }
}
