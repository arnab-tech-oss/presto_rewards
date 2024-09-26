<?php

use App\Http\Controllers\admin\setting\PagesController;
use App\Http\Controllers\User\AppsettingController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EnquireController;
use App\Http\Controllers\User\ForgotpasswordController;
use App\Http\Controllers\User\GenaralInfoController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\OfferController;
use App\Http\Controllers\User\PayoutController;
use App\Models\Role;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\RedemptionController;
use App\Http\Controllers\User\ResetPasswordControler;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\SettingPageController;
use App\Http\Controllers\User\StateController;
use App\Http\Controllers\User\WalletController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/add', [CustomerController::class, 'addcustomer'])->name('user.add');
Route::post('/customer/login', [LoginController::class, 'customerlogin']);
Route::post('/customer/password/forget',[ResetPasswordControler::class,'resetpassword']);
Route::get('/setting/page', [SettingPageController::class, 'index']);
Route::POST('/bank/api',[PayoutController::class,'bank']);
Route::post('/bank/callback',[PayoutController::class,'callback']);
Route::get('/state',[StateController::class,'state']);
Route::post('/state/district',[StateController::class,'district']);
/* App genaral setting controller done only route are pending*/
Route::get('/app/general/setting',[GenaralInfoController::class,'genaral']);

//for testing pourpose bank api
Route::get('/bank/upi',[PayoutController::class,'bankupi']);
Route::get('/bank/imps',[PayoutController::class,'bankimps']);
//for status
Route::get('/status/upi',[PayoutController::class,'upistatus']);
Route::get('/status/imps',[PayoutController::class,'impsstatus']);
//bank api end
Route::post('/forget/password/otp',[ForgotpasswordController::class,'getotp']);
Route::post('/varify/forget/password',[ForgotpasswordController::class,'varifyotp']);
Route::post('/password/reset',[ForgotpasswordController::class,'password_update']);
Route::post('/filter/product/brand',[ProductController::class, 'filterproduct']);

Route::middleware('auth:sanctum')->group(function () {
    /**********************************FOR CUSTOMER PROFILE VIEW AND UPDATE ********************/
    Route::get('/customer/view', [CustomerController::class, 'view'])->name('customer.view');
    Route::post('/customer/update', [CustomerController::class, 'customerupdate'])->name('customer.update');
    Route::post('/customer/document',[CustomerController::class,'document']);
/*************************************FOR CUSTOMER PASSWORD RESET ******************************/
    Route::post('/customer/passcode/update',[ResetPasswordControler::class,'resetpasscode']);
    //Route::post('/customer/password/forget',[ResetPasswordControler::class,'resetpassword']);
    Route::post('/reset/passcode',[ResetPasswordControler::class,'passcode']);
    Route::post('/customer/delete',[CustomerController::class,'customer_delete']);

    /************************************FOR PROFILE AND DASHBOARD *****************************/
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    /*****************************FOR PRODUCT & CATALOGS ***************************************/
    Route::post('/product',[ProductController::class,'index'])->name('customer.product');
    Route::get('/product/all-product',[ProductController::class,'allproduct']);
    Route::post('/product/details',[ProductController::class,'show']);
    Route::get('/catalog',[CatalogController::class,'index']);
    //Route::get('/catalog/show/{id}',[CatalogController::class,'show']);
    Route::get('/category',[ProductController::class,'category']);
    //Route::post('/catalog/show', [CatalogController::class, 'show']);
    //Route::post('/filter/product/brand',[ProductController::class, 'filterproduct']);

    /********************************* FOR CUSTOMER OFFER **************************************/
    Route::get('/user/offer', [OfferController::class, 'offer'])->name('user.offer');

    /*******************************************FOR PAYOUT ************************************/
    Route::post('/payout',[PayoutController::class,'payout']);
    Route::get('/payout/transaction',[PayoutController::class,'payouttransaction']);
    Route::post('/payout/upi/statuscheck',[PayoutController::class,'statuscheck']);

    /********************************* FOR CUSTOMER ENQUERY ************************************/
    Route::post('/customer/enquire', [EnquireController::class, 'enquire'])->name('customer.enquiry');
    Route::get('/customer/conversation', [EnquireController::class, 'list']);
    Route::post('/customer/comments', [EnquireController::class, 'conversation']);
    Route::post('/customer/reply', [EnquireController::class, 'reply']);
    Route::get('/enquiery/type',[EnquireController::class, 'enquerytype']);

    /********************************* FOR CUSTOMER COMPANY ************************************/
    Route::get('/customer/company', [CompanyController::class, 'company'])->name('customer.company');

    /********************************* FOR CUSTOMER APP SETTINGS*******************************/
    Route::post('/customer/appsetting', [AppsettingController::class, 'appsetting'])->name('appsetting');
    Route::post('/customer/appupdate/{id}', [AppsettingController::class, 'updateappsetting'])->name('update.appsetting');
    Route::post('/store/mobileid',[CustomerController::class, 'appsetting']);
    /*********************************FOR PRODUCT REVIEW **************************************/
    Route::post('/product/review',[ReviewController::class,'productreview']);
    Route::post('/review',[ReviewController::class,'review']);

    /**********************************FOR REDEMPTION PART *************************************/
    Route::post('/coupon/reedem', [RedemptionController::class, 'coupon']);
    Route::post('/coupon/validate', [RedemptionController::class, 'coupondata']);
    Route::get('/coupon/redemptionhistory', [RedemptionController::class, 'redemtionhistory']);

    /**********************************FOR wallet PART ********************************************/
    Route::get('/wallet/balance', [WalletController::class, 'show']);
    Route::get('/wallet/transaction', [WalletController::class, 'transaction']);
    Route::post('/wallet/transaction/add',[WalletController::class,'debit']);
    //for testing pourpose
    //Route::post('/wallet/add', [WalletController::class, 'add']);

    /************************************** FOR NOTIFICATION USE  ***********************************/
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::post('/notification/post', [NotificationController::class, 'addnotification']);
    Route::post('/payout/notification',[NotificationController::class,'payout']);
    Route::post('/notification/read',[NotificationController::class,'readnotification']);
    Route::post('/notification/delete',[NotificationController::class,'delete']);


    /******************************************************** OTP *******************************/
    Route::get('/otp/send',[CustomerController::class,'sendotp']);
    Route::post('/otp/validation',[CustomerController::class,'otpvalidation']);
    //Route::get('/information',[AppsettingController::class, 'information']);

    /*********************************** FOR LOGOUT OF CUSTOMER *************************************/

    Route::post('/customer/logout', [LoginController::class, 'logout']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
