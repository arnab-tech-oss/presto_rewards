<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Models\Qr;
use App\Models\Coupon;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CouponRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CouponRequestController extends Controller
{
    public $page = 'Coupon';

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CouponRequest::with(['company', 'product'])
                ->orderBy('created_at', 'desc');
            // dd($query->toSql());
            $data = $query->get();


            //return $data;
            return datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch form-switch-md mb-2">
                  <input class="form-check-input" type="checkbox" id="toggleSwitch_' . $row->id . '" ' . $checked . '>
                  <label class="form-check-label" for="toggleSwitch_' . $row->id . '"></label>
                   </div>';
                })
                ->addColumn('coupon_no', function ($row) {
                    $used_coupon = Coupon::where('coupon_request_id', $row->id)->where('status', 'used')->count();
                    $unused_coupon = Coupon::where('coupon_request_id', $row->id)->where('status', 'active')->count();
                    return
                        $row->no_of_coupons . ' (Used: ' . $used_coupon . ', Unused: ' . $unused_coupon . ')';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = view('admin.couponmanagement.button', ['item' => $row, 'page' => $this->page]);
                    return $actionBtn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.couponmanagement.couponrequestindex');
    }

    public function product($company_id)
    {
        //return "hi";
        $products = Product::where('brand_id', $company_id)->get();
        //return $products;
        return response()->json($products);
    }

    public function addCouponRequest()
    {
        $companies = Company::where('status', 'active')->get();
        $products = Product::where('status', 'active')->get();
        $category = Category::select('id', 'name')->where('status', 'active')->get();
        return view('admin.couponmanagement.couponrequestadd', compact('companies', 'products', 'category'));
    }

    public function storeCouponRequest(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'no_of_coupons' => 'required',
            'amount' => 'required',
            // 'company_id' => 'required',
            'expiry_date' => 'required',
            'digital' => 'required',
            // 'category_id'=>'required',
            // 'product_id'=>'required',
        ]);
        // return $data = $request->all();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Product::where('categories_id', $request->product_id)->first();
        $data = $request->all();

        // if ($request->digital) {
        //     $request->merge([
        //         'digital' => "digital",
        //     ]);
        // }

        $data['category_id'] = $category->categories_id ?? null;
        $data['expiry_date'] = $request->expiry_date;
        $data['description'] = $request->description ?? 'Null';
        //$data['expiry_date'] = now()->addDays(730);
        $data['pdf_path'] = null;
        $couponReturn =  CouponRequest::create($data);

        for ($i = 0; $i < $request->no_of_coupons; $i++) {
            $this->generateCouponCode($data, $couponReturn->id);
        }
        // if ($request->digital) {
        //     for ($i = 0; $i < $request->no_of_coupons; $i++) {
        //         $this->generatedigitalcode($data, $couponReturn->id, $request);
        //     }
        // }else {
        //     for ($i = 0; $i < $request->no_of_coupons; $i++) {
        //         $this->generateCouponCode($data, $couponReturn->id);
        //     }
        // }

        return redirect()->route('admin.coupon.request.list')->with('success', 'Coupon added successfully');
    }

    public function generateCouponCode($data, $crid)
    {
        $coupon = new Coupon();
        $time = date_create(now());
        $get_year = date_format($time, 'ym');
        $random_letter = strtoupper(Str::random(1));
        $lastNumber = Coupon::where('coupon_code', 'like', $random_letter . '%')
            ->max('coupon_code');
        $lastNumber = preg_replace('/[^0-9]/', '', $lastNumber);
        $lastNumber = $lastNumber ? intval($lastNumber) + 1 : 1;

        // Format the number to have leading zeros if needed (e.g., A001, A002, ..., A999, B001, B002, ..., Z999)
        $formattedNumber = str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

        // Combine all parts to create the coupon code
        $coupon->coupon_code = $get_year . $random_letter . $formattedNumber;
        $coupon->coupon_request_id = $crid;
        $coupon->customer_id = null;
        //$coupon->valid_until = now()->addDays(30); // Set the expiration date
        $coupon->save();
        $coupon->coupon_code  = $get_year . '' . strtoupper(Str::random(4)); // Generate a random code
        $coupon->coupon_request_id = $crid;
        $coupon->customer_id = null;
        //$coupon->valid_until = now()->addDays(30); // Set the expiration date
        $coupon->save();

        // Generate a QR code for the coupon code
        $this->generateQrCode($coupon->coupon_code);
    }

    public function generateQrCode($couponCode)
    {
        $coupon = Coupon::with(['couponRequest', 'couponRequest.company'])->where('coupon_code', $couponCode)->firstOrFail();
        //dd($coupon->couponRequest->company);
        $qr = new Qr();
        $qr->coupon_id  = $coupon->id;
        $static_text = 'This coupon voucher is exclusive to Presto Plast India Group customers. To redeem it, kindly install the PrestoRewards App and follow the redemption process.' . PHP_EOL . 'For any further queries or feedback, please email us  at help@prestorewardsapp.com or visit prestorewardsapp.com.';
        $textWithNewLines = 'Coupon No:' . $coupon->coupon_code . PHP_EOL . 'Amount:' . $coupon->couponRequest->amount;
        $qr->QRCode =  $textWithNewLines;
        $qr->save();
    }

    public function generatePdf($id)
    {

        // Get all coupon codes from the database
        $digital = CouponRequest::where('id', $id)->first();
         //return $digital;
        if ($digital->digital == 'size-2') {
            $coupons = Coupon::with(['qr' => function ($query) {
                $query->where('status', 'active');
            }], 'couponRequest.company')->where('coupon_request_id', $id)->get();
            //$data = ['title' => 'PDF with QR Code', 'coupons' => $coupons];
            return view('couponsQrPDF.qr_code_digital',compact('coupons'));


        } else  {
            $coupons = Coupon::with(['qr' => function ($query) {
                $query->where('status', 'active');
            }], 'couponRequest.company')->where('coupon_request_id', $id)->get();
            return view('couponsQrPDF.qr_code_pdf', compact('coupons'));

        }
    }

    public function downloadPdf($id)
    {

        // Get all coupon codes from the database
        $coupons = Coupon::with(['qr' => function ($query) {
            $query->where('status', 'active');
        }])->where('coupon_request_id', $id)->get();

        $qrCoupons = $this->generateQrCodesImage($coupons);

        $data = [
            'title' => 'PDF with QR Code',
            'qrCoupons' => $qrCoupons,
        ];

        // Store the PDF
        $pdf = Pdf::loadView('couponsQrPDF.qr_code_pdf_download', $data);
        $deleteFolderPath = public_path('qr_codes');
        $dd = File::cleanDirectory($deleteFolderPath);
        return $pdf->download('qr.pdf');
        //$pdfPath = public_path("storage/CouponQrCodesPDF/requestId.pdf");
        //return $pdf->download('qr.pdf');
    }

    public function generatedigitalcode($data, $digiid, Request $request)
    {
        $digi_coupon = new Coupon();
        $time = date_create(now());
        $get_year = date_format($time, 'ym');
        $random_letter = strtoupper(Str::random(1));
        $lastNumber = Coupon::where('coupon_code', 'like', $random_letter . '%')
            ->max('coupon_code');
        $lastNumber = preg_replace('/[^0-9]/', '', $lastNumber);
        $lastNumber = $lastNumber ? intval($lastNumber) + 1 : 1;

        // Format the number to have leading zeros if needed (e.g., A001, A002, ..., A999, B001, B002, ..., Z999)
        $formattedNumber = str_pad($lastNumber, 3, '0', STR_PAD_LEFT);

        // Combine all parts to create the coupon code
        $digi_coupon->coupon_code = $get_year . $random_letter . $formattedNumber;
        $digi_coupon->coupon_request_id = $digiid;
        $digi_coupon->customer_id = null;

        //$coupon->valid_until = now()->addDays(30); // Set the expiration date
        $digi_coupon->save();
        $digi_coupon->coupon_code  = $get_year . '' . strtoupper(Str::random(4)); // Generate a random code
        $digi_coupon->coupon_request_id = $digiid;
        $digi_coupon->customer_id = null;
        //$coupon->valid_until = now()->addDays(30); // Set the expiration date
        $digi_coupon->save();

        // Generate a QR code for the coupon code
        $this->generatedigitalQrcode($digi_coupon->coupon_code);
    }

    public function generatedigitalQrcode($digitalqrcode)
    {

        $coupon = Coupon::with(['couponRequest', 'couponRequest.company'])->where('coupon_code', $digitalqrcode)->firstOrFail();
        //dd($coupon->couponRequest->company);
        $qr = new Qr();
        $qr->coupon_id  = $coupon->id;
        $static_text = 'This coupon voucher is for digital Qr code exclusive to Presto Plast India Group customers. To redeem it, kindly install the PrestoRewards App and follow the redemption process.' . PHP_EOL . 'For any further queries or feedback, please email us  at help@prestorewardsapp.com or visit prestorewardsapp.com.';
        $textWithNewLines = 'Coupon No:' . $coupon->coupon_code . PHP_EOL . 'Amount:' . $coupon->couponRequest->amount . PHP_EOL . 'Brand:' . $coupon->couponRequest->company->company_name;
        $qr->QRCode =  $textWithNewLines;
        $qr->save();
    }

    // private function generateQrCodesImage($coupons)
    // {
    //     $qrCodes = [];

    //     foreach ( $coupons as $coupon ) {
    //         $qrCodeData = $coupon->coupon_code;
    //         if ( !is_dir( public_path("qr_codes") ) ) {
    //             mkdir(  public_path("qr_codes") );
    //         }

    //         $validator = Validator::make($request->all(), [
    //             'no_of_coupons' => 'required',
    //             'amount' => 'required',
    //             'company_id' => 'required',
    //         ]);
    //         //return $data = $request->all();

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();

    //         }

    //         $data = $request->all();
    //         $data['category_id'] = $request->category_id;
    //         $data['expiry_date'] = now()->addDays(30);
    //         $data['pdf_path'] = null;
    //         $couponReturn =  CouponRequest::create($data);

    //         for ($i = 0; $i < $request->no_of_coupons; $i++) {
    //             $this->generateCouponCode($data, $couponReturn->id);
    //         }

    //         return redirect()->route('admin.coupon.request.list')->with('success', 'Coupon added successfully');
    //     }

    // public function generateCouponCode($data, $crid)
    // {
    //     $coupon = new Coupon();
    //     $time = date_create(now());
    //     $get_year = date_format($time, 'Y');
    //     $coupon->coupon_code  = $get_year . '-' . strtoupper(Str::random(4)); // Generate a random code
    //     $coupon->coupon_request_id = $crid;
    //     $coupon->customer_id = null;
    //     //$coupon->valid_until = now()->addDays(30); // Set the expiration date
    //     $coupon->save();

    //     // Generate a QR code for the coupon code
    //     $this->generateQrCode($coupon->coupon_code);
    // }

    // public function generateQrCode($couponCode)
    // {
    //     $coupon = Coupon::with(['couponRequest', 'couponRequest.company'])->where('coupon_code', $couponCode)->firstOrFail();
    //     //dd($coupon->couponRequest->company);
    //     $qr = new Qr();
    //     $qr->coupon_id  = $coupon->id;
    //     $static_text = 'This coupon voucher is exclusive to Presto Plast India Group customers. To redeem it, kindly install the PrestoRewards App and follow the redemption process.' . PHP_EOL . 'For any further queries or feedback, please email us  at help@prestorewardsapp.com or visit prestorewardsapp.com.';
    //     $textWithNewLines = 'Coupon No:' . $coupon->coupon_code . PHP_EOL . 'Amount:' . $coupon->couponRequest->amount . PHP_EOL . 'Brand:' . $coupon->couponRequest->company->company_name . PHP_EOL . PHP_EOL . $static_text;
    //     $qr->QRCode =  $textWithNewLines;

    //     $qr->save();
    // }

    // public function generatePdf($id)
    // {

    //     // Get all coupon codes from the database
    //     $coupons = Coupon::with(['qr' => function ($query) {
    //         $query->where('status', 'active');
    //     }])->where('coupon_request_id', $id)->get();
    //     //$data = ['title' => 'PDF with QR Code', 'coupons' => $coupons];
    //     return view('couponsQrPDF.qr_code_pdf', compact('coupons'));
    // }

    // public function downloadPdf($id)
    // {

    //     // Get all coupon codes from the database
    //     $coupons = Coupon::with(['qr' => function ($query) {
    //         $query->where('status', 'active');
    //     }])->where('coupon_request_id', $id)->get();

    //     $qrCoupons = $this->generateQrCodesImage($coupons);

    //     $data = [
    //         'title' => 'PDF with QR Code',
    //         'qrCoupons' => $qrCoupons,
    //     ];

    //     // Store the PDF
    //     $pdf = Pdf::loadView('couponsQrPDF.qr_code_pdf_download', $data);
    //     $deleteFolderPath = public_path('qr_codes');
    //     $dd = File::cleanDirectory($deleteFolderPath);
    //     return $pdf->download('qr.pdf');
    //     //$pdfPath = public_path("storage/CouponQrCodesPDF/requestId.pdf");
    //     //return $pdf->download('qr.pdf');


    // }

    private function generateQrCodesImage($coupons)
    {
        $qrCodes = [];

        foreach ($coupons as $coupon) {
            $qrCodeData = $coupon->coupon_code;
            if (!is_dir(public_path("qr_codes"))) {
                mkdir(public_path("qr_codes"));
            }
            $qrCodePath =  "qr_codes/$qrCodeData.svg";

            // Generate QR code
            QrCode::size(200)->generate($coupon->qr[0]->QRCode, public_path($qrCodePath));

            // Compress and store QR code image

            // Add QR code data and path to the array
            $qrCodes[] = [
                'data' => $qrCodeData,
                'path' => base64_encode(file_get_contents($qrCodePath)),
                'amount' => $coupon->couponRequest->amount,
            ];
        }

        return $qrCodes;
    }
}
