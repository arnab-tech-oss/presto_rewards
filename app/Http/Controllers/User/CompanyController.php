<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function company()
    {
        $companys = Company::select('id','company_name','brand_title','logo')->where(['status' => 'active'])->orderBy('created_at', 'desc')->get();

        $baseURL = request()->root(); // Get the base URL from the configuration
    $data = $companys->map(function ($company) use ($baseURL) {
        $company->logo = $baseURL .'/'. $company->logo; // Adjust the path as per your project structure
        return $company;
    });

        if ($data->isNotEmpty()){
            return response()->json(responseData($data,"Offer Retrive Successfuly"));
            }else{
                return response()->json(responseData(null,"Sorry Currently No Offer Available",false));
            }
    }
}
