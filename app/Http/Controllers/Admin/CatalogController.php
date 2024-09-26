<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class CatalogController extends Controller
{
    public $page = 'Catalog';
    public function catalog(Request $request)
    {
        if ($request->ajax()) {
            $data = Catalog::latest('created_at');
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md mb-2">
              <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('catalog.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                          <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                      </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.catalog.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.catalog.catalog');
    }

    public function catalogstatus($id)
    {

        $user_id = auth()->id();
        $status = Catalog::where('id', $id)->first();

        if ($status->status == "active") {
            Catalog::where('id', $id)
                ->update(['status' => 'inactive', 'updated_by' => $user_id]);
            return "InActive";
        } else {
            Catalog::where('id', $id)
                ->update(['status' => 'active', 'updated_by' => $user_id]);
            return "Active";
        }
    }


    public function addcatalog()
    {
        $data = Product::select('id', 'product_name')->where('status', 'active')->get();
        return view('admin.catalog.addcatalog', compact('data'));
    }

    //   public function getProductOptions()
    // {
    //     // Replace this with your logic to fetch product options
    //     $options = Product::select('id', 'product_name')->get();

    //     return response()->json($options);
    // }


    public function postcatalog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|unique:catalogs,name',
            // 'description' => 'required',
            'product' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $id = auth()->id();
            $fullPath = null;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('images/catalog'), $imageName);
                $fullPath = 'images/catalog/' . $imageName;
            }

            $catalog = new Catalog();
            $catalog->name = $request->name;
            $catalog->description = $request->description;
            $catalog->image = $fullPath;
            $catalog->status = 'active';
            $catalog->created_by = $id;

            if ($catalog->save()) {
                $catalogId = $catalog->id;
                $product = $request->product;
                foreach ($product as $productId) {
                    if ($productId) {
                        // Update the 'catalogs_id' column in the Product table
                        Product::where('id', $productId)->update([
                            'catalogs_id' => $catalogId,
                        ]);
                    }
                }

                return redirect()->route('admin.catalog')->with('success', 'Catalog updated Successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }
    }



    public function viewcatalog($id)
    {
        $viewcatalog = Catalog::with('product')->where('id', $id)->first();
        return view('admin.catalog.viewcatalog', compact('viewcatalog'));
    }


    public function catalogedit($id)
    {

        $catalogedit = Catalog::with('product')->where('id', $id)->first();
        return view('admin.catalog.catalogedit', compact('catalogedit'));
    }

    public function catalogupdate(Request $request, $id)
    {
        $imageName = null;
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if ($validator->passes() && $request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/catalog'), $imageName);
            }
            $fullPath = 'images/catalog/' . $imageName;

            $catalog_update = Catalog::where('id', $id)->first();
            $catalog_update->name = $request->name;
            $catalog_update->description = $request->description;
            // $catalog_update->status = $request->status;
            if ($imageName !== null) {
                $catalog_update->image = $fullPath;
            }
            $catalog_update->update($catalog_update->toarray());
            return redirect()->route('admin.catalog');
        }
    }

    public function productdelete($id)
    {
        $data = Catalog::where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Record not found'], 404);
        } else {
            $data->delete();
            return response()->json(['message' => 'Record delete successfully']);
        }
    }
    // public function delete($id)
    // {
    //   $data = Catalog::where('id', $id)->first();

    //   if (!$data) {
    //       return response()->json(['error' => 'Record not found'], 404);
    //   }
    //   else
    //   {
    //       $data->delete();
    //       return response()->json(['message' => 'Record delete successfully']);
    //   }
    // }

}
