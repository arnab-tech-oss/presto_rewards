<?php
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Illuminate\Contracts\Auth\UserProvider;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AppurlController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatagoryController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\Catelog2Controller;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\RedeemtionController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\setting\PagesController;
use App\Http\Controllers\Admin\SupportticketController;
use App\Http\Controllers\Admin\UsermanagementController;
use App\Http\Controllers\Admin\ReportanalyticsController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\WalletmanagementController;
use App\Http\Controllers\Admin\Coupon\CouponRequestController;
use App\Http\Controllers\Admin\EmaillogController;
use App\Http\Controllers\Admin\WalletController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\GlobalsearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[LoginController::class,'customerlogin'])->name('admin.login');
Route::post('/admin/login/post',[LoginController::class, 'postlogin'])->name('admin.post.login');
Route::redirect('/home','/dashboard');
Route::redirect('/login','/');

/*********************************  FORGOT PASSWORD *************************************/
Route::get('forget/password',[LoginController::class,'forgotpassword'])->name('forgot.password');
Route::post('/forget/password/post',[LoginController::class,'passwordforget'])->name('paswword.post');
Route::get('/reset/password/{token}',[LoginController::class,'showResetPasswordForm'])->name('reset.password.get');


Route::middleware(['adminlogin:admin'])->group(function () {

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
Route::get('/notification/read',[DashboardController::class,'notification_status'])->name('admin.notification');
Route::get('/notification/list',[DashboardController::class,'showdata'])->name('admin.notification.list');
Route::get('/app/user',[DashboardController::class,'app_user'])->name('admin.appuser.total');

//**************************  FOR USER MANAGEMENT SYSTEM IN ADMIN SIDE *********************//
Route::get('/role',[UsermanagementController::class,'role'])->name('admin.role');
Route::get('/add/role',[UsermanagementController::class,'addrole'])->name('add.role');
Route::post('/post/add/role',[UsermanagementController::class,'postrole'])->name('post.role');
Route::get('/view/role/{id}',[UsermanagementController::class,'viewrole'])->name('view.role');
Route::get('/edit/role/{id}',[UsermanagementController::class,'editrole'])->name('edit.role');
Route::post('/update/role/{id}',[UsermanagementController::class,'updaterole'])->name('update.role');
Route::get('/delete/role/{id}',[UsermanagementController::class,'deleterole'])->name('role.delete');
Route::get('/usermanagement',[UsermanagementController::class,'usermanagement'])->name('admin.usermanagement');
Route::get('/add/user',[UsermanagementController::class,'adduser'])->name('user.add');
Route::post('/add/user/post',[UsermanagementController::class,'userpost'])->name('user.add.post');
Route::get('/user/view/{id}',[UsermanagementController::class,'userview'])->name('user.view');
Route::get('/admin/user/edit/{id}',[UsermanagementController::class,'useredit'])->name('admin.user.edit');
Route::post('/user/update/{id}',[UsermanagementController::class,'userupdate'])->name('user.update');
//Route::get('/user/inactive/{id}',[UsermanagementController::class,'inactiuser'])->name('user.inactive');

//***********************  FOR CUSTOMER MANAGEMENT SYSTEM IN ADMIN SIDE *********************//

Route::get('/customer/list',[CustomerController::class,'customerlist'])->name('admin.customerlist');
Route::get('/customer/add',[CustomerController::class,'customeradd'])->name('customer.add');
Route::post('/customer/add/post',[CustomerController::class,'addcustomer'])->name('customer.add.post');
Route::get('/customer/edit/{id}',[CustomerController::class,'editcustomer'])->name('admin.customer.edit');
Route::post('/customer/update/{id}',[CustomerController::class,'updatecustomer'])->name('admin.customer.update');
Route::get('/customer/view/{id}',[CustomerController::class,'viewcustomer'])->name('admin.customer.view');
Route::get('/customer/delete/{id}',[CustomerController::class,'deletecustomer'])->name('admin.customer.delete');
Route::get('/get/districts/{state}',[CustomerController::class,'getDistricts'])->name('get.districts');
Route::get('/customer/transaction/list/{id}',[WalletController::class,'transaction'])->name('customer.transaction');
Route::get('/get/district/{state}',[CustomerController::class,'district'])->name('customer.district');
Route::get('/customer/status/{id}',[CustomerController::class,'status'])->name('customer.status');
Route::get('/customer/district/{state}',[CustomerController::class,'get_district'])->name('cus.dis');

/***************************** FOR CATALOG SECTION IN ADMIN SIDE ******************************/
// Route::get('/catalog',[CatalogController::class,'catalog'])->name('admin.catalog');
// Route::get('/catalog/add',[CatalogController::class,'addcatalog'])->name('admin.catalog.add');
//Route::get('/api/get-options', [CatalogController::class, 'getProductOptions'])->name('api.getOptions');
// Route::post('/catalog/add/post',[CatalogController::class,'postcatalog'])->name('admin.catalog.post');
// Route::get('/catalog/status/{id}',[CatalogController::class,'catalogstatus'])->name('catalog.status');
// Route::get('/catalog/edit/{id}',[CatalogController::class,'catalogedit'])->name('admin.catalog.edit');
// Route::post('/catalog/update/{id}',[CatalogController::class,'catalogupdate'])->name('admin.catalog.update');
// Route::get('/catalog/product/delete/{id}',[CatalogController::class,'productdelete'])->name('catalog.product.delete');
// Route::get('/catalog/delete/{id}',[CatalogController::class,'delete'])->name('category.delete');
// Route::get('/catalog/view/{id}',[CatalogController::class,'viewcatalog'])->name('admin.view.catalog');

//***********************  FOR PRODUCT MANAGEMENT SYSTEM IN ADMIN SIDE *********************//

// x----------------------------App Setting Controller---------------------------------------------------x
Route::get('/catelog',[Catelog2Controller::class,'index'])->name('admin.catalog');
Route::get('/catelog/add',[Catelog2Controller::class,'add'])->name('admin.catelogadd');
Route::post('/catelog/store',[Catelog2Controller::class,'store'])->name('admin.catelogstore');
Route::get('/catalog/status/{id}',[Catelog2Controller::class,'catalogstatus'])->name('catalog.status');
Route::get('/catalog/view/{id}',[Catelog2Controller::class,'viewcatalog'])->name('admin.view.catalog');
Route::get('/catalog/edit/{id}',[Catelog2Controller::class,'catalogedit'])->name('admin.catalog.edit');
Route::post('/catelog/update/{id}',[Catelog2Controller::class,'catalogupdate'])->name('admin.catalog.update');
// x----------------------------App Setting Controller---------------------------------------------------x
Route::get('/app/setting',[AppSettingController::class,'appsetting'])->name('admin.app.set');
Route::post('/app/post',[AppSettingController::class,'create'])->name('admin.app.store');

Route::get('/app/company',[AppSettingController::class,'company'])->name('admin.app.company');
Route::post('/app/company/post',[AppSettingController::class,'insert'])->name('admin.store.company');

Route::get('/app/finance',[AppSettingController::class,'finance'])->name('admin.app.finance');

Route::get('/app/app-key',[AppSettingController::class,'appkey'])->name('admin.app.appkey');
Route::post('/post/app-key',[AppSettingController::class,'store'])->name('admin.appkey.store');

Route::get('/app/miscellaneous',[AppSettingController::class,'view'])->name('admin.app.miscellaneous');
Route::post('/app/post/miscellaneous',[AppSettingController::class,'add'])->name('admin.post.miscellaneous');

Route::get('/app/media',[AppSettingController::class,'media'])->name('admin.app.media');
Route::post('/app/media/post',[AppSettingController::class,'post_media'])->name('admin.post.media');
// x----------------------------App Setting Controller---------------------------------------------------x
Route::get('/product',[ProductController::class,'product'])->name('admin.product');
Route::post('/product/lists', [DashboardController::class,'index']) -> name ('admin.product.lists');
Route::get('/add/product',[ProductController::class,'addproduct'])->name('admin.add.product');
Route::post('/add/product/post',[ProductController::class,'productpost'])->name('admin.product.post');
Route::get('/product/edit/{id}',[ProductController::class,'productedit'])->name('product.edit');
Route::post('/product/update/{id}',[ProductController::class,'productupdate'])->name('product.update');
Route::get('/product/activate/{id}',[ProductController::class,'productstatus'])->name('product.status');
Route::get('/catalogproduct',[ProductController::class,'catalogproduct'])->name('catalog.produhct');
Route::get('/add/catalog/product',[ProductController::class,'addcatalogproductview'])->name('add.catalog.product');
Route::post('/add/catalog/product/post',[ProductController::class,'postcatalogproduct'])->name('post.catalog.product');

Route::get('/view/product/{id}',[ProductController::class,'viewproduct'])->name('admin.view.product');
Route::get('/product/delete/{id}',[ProductController::class,'productdelete'])->name('product.delete');
Route::get('/upload-product/csv', [ProductController::class, 'csv_productUploadview'])->name('product.upload');
Route::get('/download-product/csv', [ProductController::class, 'csv_productDownloadview'])->name('product.download');
Route::get('/download/csv', [ProductController::class, 'csv_productDownload'])->name('product.csv.download');
Route::post('/product/upload/csv', [ProductController::class, 'csv_productupload'])->name('upload.books.csv');
//Route::get('/autocomplete',[ProductController::class,'autocomplete'])->name('search.autocomplete');

Route::get('/product/search/{id?}',[ProductController::class,'serachproduct'])->name('product.search');
Route::get('/company/search/{id?}',[CompanyController::class,'serachproduct'])->name('comapany.search');
Route::get('/customer/search/{id?}',[CustomerController::class,'serachproduct'])->name('customer.search');
Route::get('/coupon/search/{id}',[CouponController::class,'serachproduct'])->name('coupon.search');

// ******************************Appurl controller************************************
Route::get('/admin/appurl',[AppurlController::class,'appurl'])->name('admin.appurl');

// ***********************************Categoryadd Controller***********************************//

// *****************************catagorycontroller***********************************


Route::get('/category',[CatagoryController::class,'index'])->name('category.list');
Route::get('/category/add',[CatagoryController::class,'add'])->name('category.add');
Route::get('/product/autocomplete',[CatagoryController::class,'autocomplete'])->name('product.autocomplete');
Route::post('/category/post',[CatagoryController::class,'create'])->name('category.add.post');
Route::get('category/edit/{id}',[CatagoryController::class,'edit'])->name('category.edit');
Route::post('category/post/{id}',[CatagoryController::class,'update'])->name('category.update');
Route::post('/catelog/product/delete/{id}',[CatalogController::class,'delete'])->name('catelog.delete');
Route::get('/category/delete/{id}',[CatagoryController::class,'delete_catagory'])->name('category.delete');
Route::get('/category/activate/{id}',[CatagoryController::class,'categorystatus'])->name('category.status');
Route::get('category/view/{id}',[CatagoryController::class,'catagoryview'])->name('category.view');
//***********************  FOR COMPANY MANAGEMENT SYSTEM IN ADMIN SIDE *********************//
Route::get('/company',[CompanyController::class,'company'])->name('admin.company');
Route::get('/company/add',[CompanyController::class,'addcompany'])->name('company.add');
Route::post('/company/companyadd',[CompanyController::class,'companypost'])->name('admin.company.post');
Route::get('/company/edit/{id}',[CompanyController::class,'edit'])->name('admin.company.edit');
Route::post('/company/update/{id}',[CompanyController::class,'companyupdate'])->name('company.udate');
Route::get('/company/delete/{id}',[CompanyController::class,'deletecompany'])->name('company.delete');
Route::get('/company/status/{id}',[CompanyController::class,'status'])->name('company.status');
Route::get('/company/view/{id}',[CompanyController::class,'view'])->name('company.view');
//*****************************************FOR OFFERS **************************************//
Route::get('/offer',[OfferController::class,'offer'])->name('admin.offer');
Route::get('/offer/add',[OfferController::class,'addoffer'])->name('admin.add.offer');
Route::post('/offer/post',[OfferController::class,'offerpost'])->name('offer.post');
Route::get('/offer/inactive/{id}',[OfferController::class,'inactiveoffer'])->name('offer.inactive');
Route::get('/offer/edit/{id}',[OfferController::class,'offeredit'])->name('admin.offer.edit');
Route::post('/offer/update/{id}',[OfferController::class,'update'])->name('admin.offer.update');
Route::get('/offer/view/{id}',[OfferController::class,'offerview'])->name('admin.offer.view');
//*************************************** FOR REDEMPTION REQUEST *******************************//
Route::get('/redemption',[RedeemtionController::class,'index'])->name('redeemption');
Route::get('/request/approved/{id}',[RedeemtionController::class,'approve'])->name('request.approved');
Route::post('/request/reject',[RedeemtionController::class,'reject'])->name('request.rejected');
Route::post('/request/ajaxAllApproved',[RedeemtionController::class,'ajaxAllApproved'])->name('request.all_approved');
Route::post('/request/ajaxAllreject',[RedeemtionController::class,'ajaxAllreject'])->name('request.all_reject');
Route::get('/redemption/approve',[RedeemtionController::class,'sts_ch'])->name('redeemption.approve');
Route::get('/redemption/reject',[RedeemtionController::class,'cancel'])->name('redeemption.reject');
//****************************************FOR COUPON MANAGEMENT SYSTEM **********************\

Route::get('/coupon/request_list',[CouponRequestController::class,'index'])->name('admin.coupon.request.list');
Route::get('/coupon/request_add',[CouponRequestController::class,'addCouponRequest'])->name('admin.coupon.request.add');
Route::post('/coupon/storeCoupon',[CouponRequestController::class,'storeCouponRequest'])->name('admin.coupon.store');
Route::get('/getCouponQrPdf/{id}',[CouponRequestController::class,'generatePdf'])->name('admin.coupon.pdf');
Route::get('/getCouponQrDownload/{id}',[CouponRequestController::class,'downloadPdf'])->name('admin.coupon.qr.download');
Route::get('/getCouponQrView/{id}',[CouponController::class,'index'])->name('admin.coupon.view');
Route::get('/select/product/{company_id}',[CouponRequestController::class,'product'])->name('select.product');
// x------------------------------------Payout Controller---------------------------------------------------------------x
Route::get('/payout',[PayoutController::class,'payout'])->name('admin.payout');
Route::post('/status/update',[PayoutController::class,'update'])->name('admin.button');
Route::get('/payout/pdf/{id}',[PayoutController::class,'payout_pdf'])->name('payout.document');
Route::get('/transaction',[PayoutController::class,'transaction'])->name('admin.trans');
Route::get('/transaction/pdf/{id}',[PayoutController::class,'document'])->name('transaction.document');
Route::get('/view/transaction/{id}',[PayoutController::class,'view'])->name('transaction.view');
//  x-----------------------------------Payout Controller----------------------------------------------------------------x

//****************************************FOR SETTINGS******************************* */
Route::get('setting/', [SettingController::class,'index'])->name('admin.setting.index');
Route::post('settings/store', [SettingController::class,'store'])->name('admin.setting.store');

//********************************  FOR LOGOUT SYSTEM IN ADMIN SIDE ***************************//
Route::get('/admin/logout',[LoginController::class,'adminlogout'])->name('admin.logout');

/***********************************FOR SETTING PAGE *****************************************/
Route::get('/user/addpages',[PagesController::class,'showpage'])->name('admin.setting.showpages');
Route::post('/user/page/add',[PagesController::class,'addpage'])->name('admin.setting.addpages');
Route::get('/user/showdata',[PagesController::class,'showdata'])->name('admin.setting.showdata');
Route::get('/user/edit/{id}',[PagesController::class,'edit'])->name('admin.setting.edit');
Route::post('/setting/update/{id}',[PagesController::class,'update'])->name('admin.setting.update');
Route::get('/setting/delete/{id}',[PagesController::class,'deletepage'])->name('page.delete');
Route::get('/setting/status/{id}',[PagesController::class,'status'])->name('page.status');

//******************************Wallet Management ************************************ */
Route::get('/wallet/list',[WalletmanagementController::class,'walletlist'])->name('admin.walletmanagement.list');
Route::get('/wallet/active/{id}',[WalletmanagementController::class,'walletstatus'])->name('admin.wallet.status');
Route::get('/customer/admin/transaction/{id}',[WalletmanagementController::class,'transactionview'])->name('admin.wallet.transaction');
Route::get('/all/transaction/history',[WalletmanagementController::class,'alltrancaction'])->name('admin.all.trans');
Route::get('/all/transaction/view/{id}',[WalletmanagementController::class,'viewtrancaction'])->name('wallate.transection.view');

// ******************************   Marketing Management       ************************************ */
Route::get('/marketing/tools',[MarketingController::class,'marketingtool'])->name('admin.marketing.tool');

//*******************************   Reportanalytics Management   ************************************ */
Route::get('/report/analytics',[ReportanalyticsController::class,'reportlist'])->name('admin.report.list');
Route::get('/bulk/email',[ReportanalyticsController::class,'bulkemail'])->name('admin.analytics');
Route::get('/report/list/customer/{id}',[ReportanalyticsController::class,'customerlist'])->name('report.customer');

//*******************************    Support Ticket  ************************************************/
Route::get('/support/ticket',[SupportticketController::class,'ticket'])->name('admin.support.ticket');
Route::get('/support/comments',[SupportticketController::class,'comments'])->name('admin.support.comment');
Route::get('/support/view/{id}',[SupportticketController::class,'view'])->name('support.comment.view');
Route::post('/support/message/post',[SupportticketController::class,'messege'])->name('message.post');
Route::get('/ticket/add',[SupportticketController::class,'add'])->name('admin/tic/post');
Route::post('/ticket/create',[SupportticketController::class,'ticketadd'])->name('admin.tic.cre');
Route::get('/ticket/list',[SupportticketController::class,'ticketlist'])->name('admin.tic.list');
Route::get('/support/status/{id}',[SupportticketController::class,'tickit_status'])->name('support.tickit.status');
Route::get('/ticket/view/{id}',[SupportticketController::class,'ticket_view'])->name('admin.ticket.view');
Route::get('/support/comments/{id}',[SupportticketController::class, 'changestatus'])->name('admin.ticket.status');

//*******************************Redeemtion Management ***************************** */
Route::get('/redeemption/pending',[RedeemtionController::class,'pending'])->name('admin.redeemption.pening');
Route::get('/redeemption/rejected',[RedeemtionController::class,'rejected'])->name('admin.redeemption.rejected');


/****************************************FOR ACCOUNT MENU *****************************************/
Route::get('/account/payment',[AccountController::class,'index'])->name('account.payment');
Route::get('/account/transaction',[AccountController::class,'transaction'])->name('account.transaction');


//***************************************Admin Controller******************************************* */
Route::get('/admin/view',[AdminController::class,'index'])->name('admin.view.index');
 Route::get('/admin/list',[AdminController::class,'adminshow'])->name('admin.list');
Route::get('/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
Route::post('/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');
Route::post('/admin/update/address/{id}',[AdminController::class,'adminaddress'])->name('admin.addrss.update');
/********************************************FOR WALLET MANAGEMENT *********************************/
Route::get('/admin/product/review',[ProductController::class,'product_review'])->name('admin.product.review');
Route::get('/admin/review/edit/{id}',[ProductController::class,'review_edit'])->name('admin.review.edit');
Route::post('/admin/review/update/{id}',[ProductController::class,'review_update'])->name('admin.review.update');
Route::get('/admin/review/delete/{id}',[ProductController::class,'review_delete'])->name('admin.review.delete');

Route::get('/wallet/list',[WalletmanagementController::class,'walletlist'])->name('admin.walletmanagement.list');
Route::get('/admin/transaction/{id}',[WalletmanagementController::class,'transactionview'])->name('admin.view');

//********************************  FOR EMAILLOG  ***************************//

Route::get('/email/log/index',[EmaillogController::class, 'index'])->name('admin.email.log');
Route::get('/email/log/view/{id}',[EmaillogController::class, 'view'])->name('admin.email.logview');

//********************************  FOR LOGOUT SYSTEM IN ADMIN SIDE ***************************//
Route::get('/admin/logout',[LoginController::class,'adminlogout'])->name('admin.logout');
});
//  x------------------------------GlobalsearchController -----------------------------------------------x
// Route::any('global/search', [GlobalsearchController::class, 'index'])->name('global.search');
Route::post('global/search/{search}', [GlobalsearchController::class, 'index'])->name('global.search');
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
