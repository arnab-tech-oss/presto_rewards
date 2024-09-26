<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductCatalog;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\ProductReviews;
use App\Models\CatalogProduct;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public $page = 'Catalog';
    public $page1 = 'Product';

    //   public function search(Request $request)
    //   {
    //     {
    //       if($request->has('searchQuery')){
    //           $trains = Product::search($request->searchQuery)
    //               ->paginate(6);
    //       }
    //       return response($trains);
    //   }
    // }
    public function catalog(Request $request)
    {
        if ($request->ajax()) {
            $data = Catalog::get();
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md mb-2">
                      <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('product.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                      <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                  </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.productmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.productmanagement.productindex');
    }


    public function productstatus($id)
    {

        $user_id = auth()->id();
        $status = Product::where('id', $id)->first();

        if ($status->status == "active") {
            Product::where('id', $id)
                ->update(['status' => 'inactive', 'updated_by' => $user_id]);
            return "InActive";
        } else {
            Product::where('id', $id)
                ->update(['status' => 'active', 'updated_by' => $user_id]);
            return "Active";
        }
    }


    public function addcatalog()
    {
        $products = Product::all();
        return view('admin.productmanagement.addcatalog', compact('products'));
    }

    public function postcatalog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required|unique:catalogs,name',
            // 'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $id = auth()->id();

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/catalog'), $imageName);
            $fullPath = 'images/catalog/' . $imageName;

            $catalog = new Catalog();
            $catalog->name = $request->name;
            $catalog->description = $request->description;
            $catalog->image = $fullPath;
            $catalog->status = 'active';
            $catalog->created_by = $id;
            $catalog->save();

            if ($catalog->save()) {
                return redirect()->route('admin.catalog')->with('success', 'Catalog update Successfully');
            } else {
                return redirect()->back()->with('error', 'somet6hing went wrong');
            }
        }
    }

    public function catalogstatus($id)
    { {
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
    }

    public function catalogedit($id)
    {

        $catalogedit = Catalog::where('id', $id)->first();
        return view('admin.productmanagement.catalogedit', compact('catalogedit'));
    }

    public function catalogupdate(Request $request, $id)
    {
        $imageName = null;
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->passes() && $request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/catalog'), $imageName);
        }
        $fullPath = 'images/catalog/' . $imageName;

        $catalog_update = Catalog::where('id', $id)->first();
        $catalog_update->name = $request->name;
        $catalog_update->description = $request->description;
        $catalog_update->status = $request->status;
        if ($imageName !== null) {
            $catalog_update->image = $fullPath;
        }
        $catalog_update->update($catalog_update->toarray());
        return redirect()->route('admin.catalog');
    }




    public function product(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category', 'company')->latest();
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md mb-2">
                        <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . ' onclick="changeStatus(\'' . route('product.status', ['id' => $row->id]) . '\', \'status' . $row->id . '\')">
                        <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.productmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.productmanagement.productindex');
    }


    public function addproduct()
    {
        $brand = Company::select('id', 'brand_title')->where('status', 'active')->get();
        $category = Category::select('id', 'name')->where('status', 'active')->get();
        $catalog = Catalog::select('id', 'name')->where('status', 'active')->get();
        return view('admin.productmanagement.addproduct', compact('brand', 'category', 'catalog'));
    }

    public function viewproduct($id)
    {
        $editproduct = Product::where('id', $id)->first();
        return view('admin.productmanagement.viewproduct', compact('editproduct'));
    }

    public function productpost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //   'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'product_name' => 'required|unique:catalogs,name',
            // 'description' => 'required',
            'brand_id' => 'required',
            'category' => 'required',
            // 'price_range' => 'required',
            // 'product_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $id = auth()->id();

            //   if ($request->hasFile('image')) {
            //   $imageName = time() . '.' . $request->image->extension() ?? "";
            //   $request->image->move(public_path('images/product'), $imageName);
            //   $fullPath = 'images/product/' . $imageName;


            //   }else{
            //     Log::warning('No file uploaded.');
            //     return redirect()->route('admin.product');
            //   }

            $entity = new Product();
            $entity->product_name = $request->product_name;
            $entity->description = $request->description;
            $entity->price_range = $request->price_range;
            //   $entity->image = $fullPath;
            $entity->product_code = $request->product_code;
            $entity->catalogs_id = $request->catalog_id;
            $entity->categories_id = $request->category;
            $entity->brand_id = $request->brand_id;
            $entity->created_by = $id;
            $entity->save();
        }

        if ($entity->save()) {
            return redirect()->route('admin.product')->with('success', 'Product Successfully add');
        } else {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    public function productedit($id)
    {

        $product_edit = Product::where('id', $id)->first();
        return view('admin.productmanagement.productedit', compact('product_edit'));
    }

    public function productupdate(Request $request, $id)
    {
        $imageName = null;
        $productid = $request->id;

        if ($request->hasAny(['image', 'description', 'price_range'])) {
            $validator = Validator::make($request->all(), [
                'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg',
                // 'description' => 'required',
                'price_range' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $id = auth()->id();

                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('images/product'), $imageName);
                    $fullPath = 'images/product/' . $imageName;
                }

                $product_updates = Product::where('id', $productid)->first();

                $product_updates->description = $request->description;
                $product_updates->price_range = $request->price_range;
                if ($imageName) {
                    $product_updates->image = $fullPath;
                }
                $product_updates->updated_by = $id;
                $product_updates->update($product_updates->toArray());

                return redirect()->route('admin.product')->with('update_success', 'Product Updated Successfull');
            }
        } else {
            return redirect()->back()->with('error', 'some thing went wrong');
        }
    }


    public function productdelete($id)
    {
        $data = Product::where('id', $id)->first();

        if (!$data) {
            return response()->json(['error' => 'Record not found'], 404);
        } else {
            $data->delete();
            return response()->json(['message' => 'Record delete successfully']);
        }
    }

    public function serachproduct($id)
    {
        $data = Product::where('id', $id)->first();
        return $data;
    }

    public function product_review(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductReviews::with('customer', 'productreview')->orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Assuming 'button' is a partial view located at 'admin.reviewmanagement.button'
                    $actionBtn = view('admin.reviewmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.reviewmanagement.reviewindex');
    }


    public function review_edit(Request $request, $id)
    {
        $review_edit = ProductReviews::where('id', $id)->first();
        return view('admin.reviewmanagement.reviewedit', compact('review_edit'));
    }

    public function review_update(Request $request, $id)
    {
        $review_updates = ProductReviews::where('id', $id)->first();

        $review_updates->scale = $request->scale;
        $review_updates->reviewtext = $request->reviewtext;
        $review_updates->status = $request->status;

        $review_updates->update();

        return redirect()->route('admin.product.review')->with('update_success', 'Review Updated Successfull');
    }

    public function review_delete(Request $request, $id)
    {
        $data = ProductReviews::where('id', $id)->first();
        if (!$data) {
            return response()->json(['error' => 'Record not found'], 404);
        } else {
            $data->delete();
            return redirect()->route('admin.product.review')->with('delete_success', 'Review Deleted Successfull');
        }
    }

    public function csv_productDownload()
    {
        return Excel::download(new ProductExport, 'products.csv');
    }

    public function csv_productDownloadview()
    {
        return view('admin.productmanagement.download-csv');
    }

    public function csv_productUploadview()
    {

        return view('admin.productmanagement.upload-csv');
    }

    public function csv_productupload(Request $request)
    {
        if ($request->ajax()) {
            $file = $request->file('upload_file');
            $parsedData = [];
            if (($open = fopen($file->getRealPath(), "r")) !== false) {
                // Log::info('File opened successfully');
                $r = 0;
                while (($row = fgetcsv($open, 1000, ",")) !== false) {
                    Log::info('Processing row', ['row_number' => $r, 'row_data' => $row]);
                    if ($r > 0) {
                        // print_r($row);
                        // Log::info('Reached this point');
                        // Log::info('CSV Row:', $row);
                        $data = new Product();
                        $data->product_name = $row[0];
                        $data->description = $row[1];
                        $data->brand_id = $row[2];
                        $data->categories_id = $row[3];
                        $data->product_code = $row[4];
                        $data->image = $row[5] ? $row[5] : "images/product/default_image-01.jpg";
                        $data->save();

                        $parsedData[] = [
                            'product_name' => $row[0],
                            'description' => $row[1],
                            'brand_id' => $row[2] ?? null,
                            'categories_id' => $row[3] ?? null,
                            'product_code' => $row[4]
                        ];
                    }
                    $r++;
                }
                fclose($open); // Always close the file after opening
            } else {
                Log::error('Failed to open the file');
            }
            // Log::info('Upload successful', ['data' => $parsedData]);
            $return = ["status" => "success", "msg" => "Product is uploaded Successfully", "data" => $parsedData];
            return response()->json($return);
        }
    }
}
