<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CatagoryController extends Controller
{
    public $page = "category";
    public $page1 = "delete";
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest('created_at');

            if ($request->filled('from_date') && $request->filled('end_date')){
                $data = $data->whereBetween('created_at', [$request->from_date, $request->end_date]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';
                 return '<div class="form-check form-switch form-switch-md mb-2">
                  <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('category.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                  <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.category.button',['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
                 }
                   return view('admin.category.index');
    }


    public function categorystatus($id)
    {
        {
            $user_id = auth()->id();
            $status = Category::where('id',$id)->first();

              if ($status->status == "active")
              {
                Category::where('id',$id)
                  ->update(['status' => 'block', 'updated_by' => $user_id]);
                  return "InActive";
              }else{
                Category::where('id', $id)
                  ->update(['status' => 'active', 'updated_by' => $user_id]);
                  return "Active";
              }
          }
    }

    public function add()
    {

        $data = Product::select('product_name', 'id')->whereNull('categories_id')->get();
        return view('admin.category.add', compact('data'));
    }

    // public function autocomplete(Request $request)
    // { {

    //         $data = [];



    //         if ($request->filled('q')) {

    //             $data = Product::select("product_name", "id")

    //                 ->where('product_name', 'LIKE', '%' . $request->get('q') . '%')

    //                 ->get();
    //         }



    //         return response()->json($data);
    //     }
    // }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            //  'products' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $id = auth()->id();

            $imageName = time() . '.' . $request->file('image')->extension();
            if (!File::exists("images/category")) {
                File::makeDirectory("images/category");
            }
            $request->file('image')->move(public_path('images/category'), $imageName);
            $fullPath = 'images/category/' . $imageName;

            $data = $request->all();
            $data['image'] = $fullPath;
            $data['created_by'] = $id;
            $save = Category::create($data);

            // if ($save && isset($data['products']) && is_array($data['products']) ) {
            //     $categories_id = $save->id;
            //     $product = $request->products;
            //     foreach ($product as $productid) {
            //         if (($productid )&& count($data['productid']) > 0) {
            //             // Update the 'catalogs_id' column in the Product table
            //             Product::where('id', $productid)->update([
            //                 'categories_id' => $categories_id,
            //             ]);
            //         }
            //     }
                if ($save) {
                    return redirect()->route('category.list')->with('success', 'Category update Successfully');
            //     } else {
                    // return redirect()->back()->with('failure', 'somet6hing went wrong');
                }
            }
    }
    public function catagoryview($id)
    {
        $viewcat= Category::with('product')->where('id',$id)->first();
        return view('admin.category.viewcatag',compact('viewcat'));
    }


    public function edit(Request $request,$id)
    {
        $data = Category::with('product')->where('id',$id)->first();
        if ($request->ajax()) {
            return Datatables::of($data->product)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.category.button', ['item' => $row, 'page' => $this->page1]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $product = Product::whereNull('categories_id')->where('status','active')->get();
        return view('admin.category.edit',compact('data','product'));
    }

    public function update(Request $request,$id)
    {
        $imageName = null;
        $validator = Validator::make($request->all(), [
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->passes() && $request->hasFile('image')) {
          $imageName = time() . '.' . $request->image->extension();
          $request->image->move(public_path('images/category'), $imageName);
        }
        $fullPath = 'images/category/' . $imageName;

        $category_update = Category::where('id', $id)->first();
        $category_update->name = $request->name;
        $category_update->description = $request->description;
        // $catalog_update->status = $request->status;
        if ($imageName !== null) {
            $category_update->image = $fullPath;
        }
        $category_update->update($category_update->toarray());
        return redirect()->route('category.list');
      }


    public function delete_catagory($id)
    {
        $data = Category::where('id', $id)->first();

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


