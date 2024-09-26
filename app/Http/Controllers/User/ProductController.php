<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\ProductReviews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::select('id', 'product_name', 'image', 'product_code')->where('status', 'active');

        if ($request->has('catalogs_id')) {
            $query->where('catalogs_id', $request->input('catalogs_id'));
        }

        if ($request->has('categories_id')) {
            $query->where('categories_id', $request->input('categories_id'));
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        $products = $query->get();

        if ($request->has('catalogs_id') || $request->has('categories_id') || $request->has('brand_id')) {
            // Filtered request, modify the response as needed
            $baseURL = request()->root(); // Get the base URL from the configuration
            $data = $products->map(function ($product) use ($baseURL) {
                $product->image = $baseURL . '/' . $product->image; // Adjust the path as per your project structure
                return $product;
            });

            if ($data->isNotEmpty()) {
                return response()->json(responseData($data, "Product retrieve successfully"));
            } else {
                return response()->json(responseData(null, "No products available for the specified filters", false));
            }
        } else {
            // No filters, return all data
            $baseURL = request()->root(); // Get the base URL from the configuration
            $data = $products->map(function ($product) use ($baseURL) {
                $product->image = $baseURL . '/' . $product->image; // Adjust the path as per your project structure
                return $product;
            });

            if ($data->isNotEmpty()) {
                return response()->json(responseData($data, "All products retrieved successfully"));
            } else {
                return response()->json(responseData(null, "No products available", false));
            }
        }
    }

    public function allproduct()
    {
        $data = Product::select('id', 'product_name', 'image', 'product_code')->where('status', 'active')->get();
        if ($data) {
            return response()->json(responseData($data, "All products retrieved successfully"));
        } else {
            return response()->json(responseData(null, "No products available", false));
        }
    }

    public function category()
    {
        $catalogs = Category::select('id', 'name', 'image')->get();

        $baseURL = request()->root(); // Get the base URL from the configuration
        $data = $catalogs->map(function ($catalog) use ($baseURL) {
            $catalog->image = $baseURL . '/' . $catalog->image; // Adjust the path as per your project structure
            return $catalog;
        });

        if ($data->isNotEmpty()) {
            return response()->json(responseData($data, "category data"));
        } else {
            return response()->json(responseData(null, "no active cat present", false));
        }
    }



    public function show(Request $request)
    {
        $id = $request->id;
        $baseURL = request()->root();
        // $products = Product::where('id', $id)->first();
        $products = Product::firstOrNew(['id' => $id]);

        if ($products->description === null || $products->description === '') {

            $products->setAttribute('description', "Electrical");
            $products->image = $baseURL . '/' . $products->image;

        }else if($products->description != null){
            $products->image = $baseURL . '/' . $products->image;
        }

            if ($products->exists || $products->save()) {
            return response()->json(responseData($products, "Product Details"));
        } else {
            return response()->json(responseData(null, "Something Went Wrong", false));
        }
    }



    // public function productreview(Request $request)
    // {
    //   $id = auth('sanctum')->user()->id;
    //   $validator = Validator::make($request->all(),[

    //     'scale' => 'required',
    //     'reviewtext' => 'required',
    //   ]);
    //   if( $validator->fails() ){

    //     return response()->json(responseData(null,$validator->errors(),false));

    //    }else{

    //     $productreview = new ProductReviews();
    //     $productreview->scale = $request->scale;
    //     $productreview->reviewtext = $request->reviewtext;
    //     $productreview->customer_id = $id;
    //     $productreview->save();
    //   }
    //     if($productreview->save()){
    //     return response()->json(responseData($productreview,'data inserted successfully'));
    //     }

    // }

    public function filterproduct(Request $request)
    {
        $products = Product::with('company')->where('brand_id', $request->brand_id)->get();
        $baseURL = request()->root();
        $data = $products->map(function ($product) use ($baseURL) {
            $product->image = $baseURL . '/' . $product->image;
            return $product;
        });

        return response()->json(responseData($data, 'all data retrive'));
    }
}
