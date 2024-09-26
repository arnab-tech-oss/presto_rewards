<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductReviews;

class ReviewController extends Controller
{
  public function productreview(Request $request)
  {
    $id = auth('sanctum')->user()->id;

    $validator = Validator::make($request->all(), [
      'scale' => 'required',
      'reviewtext' => 'required',
      'product_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(responseData(null, $validator->errors(), false));
    } else {

      $productreview = new ProductReviews();
      $productreview->scale = $request->scale;
      $productreview->reviewtext = $request->reviewtext;
      $productreview->customer_id = $id;
      $productreview->product_id = $request->product_id;
      $productreview->status = 'pending';
      $productreview->save();
    }
    if ($productreview->save()) {
      return response()->json(responseData($productreview, 'data inserted successfully'));
    } else {
      return response()->json(responseData(null, "something went wrong"));
    }
  }

  public function review(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'product_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(responseData(null, $validator->errors(), false));
    } else {
      $reviews = ProductReviews::with(['customer' => function ($query) {
        $query->select('id','first_name','last_name'); // Select only the necessary columns (id and name)
    }])
        ->where('product_id', $request->product_id)->where('status','approve')->orderBy('created_at', 'desc')
        ->get();

        $reviews->transform(function($review){
          $review->reviewtext = ucwords($review->reviewtext);
          $review->customer->first_name = ucwords($review->customer->first_name);
          $review->customer->last_name = ucwords($review->customer->last_name);
          return $review;
        });
      $totalReviews = $reviews->count();

        $data = [
            'reviews' => $reviews,
            'total_reviews' => $totalReviews,
        ];
    }
    if($data){
      return response()->json(responseData($data,"all riview retrive",));
    }else{
      return response()->json(responseData(null,"no review present",false));
    }
  }
}
