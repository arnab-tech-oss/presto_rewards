<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function offer()
    {
        $id = auth('sanctum')->user()->new_role_id;
        $offers = Offer::where('status', 'active')
            ->where(function ($query) use ($id) {
                $query->where('role_id', $id)
                    ->orWhere('role_id', null);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $baseURL = request()->root(); // Get the base URL from the configuration
        $data = $offers->map(function ($offer) use ($baseURL) {
            $offer->baner = $baseURL . '/' . $offer->baner;
            $offer->big_image = $baseURL . '/' . $offer->big_image; // Adjust the path as per your project structure
            return $offer;
        });

        if ($data->isNotEmpty()) {
            return response()->json(responseData($data, "Offer Retrive Successfuly"));
        } else {
            return response()->json(responseData(null, "Sorry Currently No Offer Available", false));
        }
    }
}
