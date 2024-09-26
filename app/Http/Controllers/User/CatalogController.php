<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\CatalogProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::where('status', 'active')->orderBy('created_at', 'desc')->get();

        $baseURL = request()->root(); // Get the base URL from the configuration
        $data = $catalogs->map(function ($catalog) use ($baseURL) {
            $catalog->image = $baseURL . '/' . $catalog->image; // Adjust the path as per your project structure
            return $catalog;
        });

        if ($data->isNotEmpty()) {
            return response()->json(responseData($data, "catalog data"));
        } else {
            return response()->json(responseData(null, "no active catalog present", false));
        }
    }
}

//     public function show(Request $request)
//     {
//         $baseURL = request()->root();
//         $data = CatalogProduct::with('catalog', 'product')
//         ->when($request->catalog_id, function ($query) use ($request) {
//             return $query->where('catalog_id', $request->catalog_id);
//         })
//         ->get();

//     if ($data->isEmpty() && $request->brand_id) {
//         $data = Product::where('brand_id', $request->brand_id)
//             ->get();
//     } elseif ($data->isEmpty() && $request->categories_id) {
//         $data = Product::where('categories_id', $request->categories_id)
//             ->get();
//     }


//     if ($data->isNotEmpty()) {
//         $productData = [];

//         foreach ($data as $catalogProduct) {
//             $productData[] = [
//                 'id' => $catalogProduct->product->id,
//                 'product_name' => $catalogProduct->product->product_name,
//                 'image' => $baseURL .'/'. $catalogProduct->product->image,
//                 // 'catalog_name' => $catalogProduct->catalog->name,

//             ];
//         }

//         return response()->json(responseData($productData));
//     } else {
//         return response()->json(responseData(null, "fault", false));
//     }
//     }
// }
