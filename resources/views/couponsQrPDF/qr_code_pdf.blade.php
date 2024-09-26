{{-- <!DOCTYPE html>
<html>
<head>
    <title>QR Code PDF</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Coupon List</h4>
        </div>
    </div>
    <div class="row">
    @foreach ($coupons as $coupon)
    <div class="col-md-3">
        <div style="text-align: center; background-color: #007BFF; color: #ffffff; padding: 20px;">
            <h2>Special Offer</h2>
            <p>Save Rs.{{ $coupon->couponRequest->amount }} on your next purchase!</p>
            <p>Use promo code: <strong>{{ $coupon->coupon_code }}</strong></p>
            <p>Amount: Rs.{{ $coupon->couponRequest->amount }}</p>
        {!! QrCode::size(100)->backgroundColor(255,225,225, 0)->generate($coupon->qr[0]->QRCode) !!}    <div></div>
    {{-- <p>{{$coupon->coupon_code}} </p>   --}}
{{-- </div>
@endforeach
</div>
</div>
</body>
</html>  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PrestoReward</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }

        .coupon-amnt {
            color: #5c4ca0;
            position: absolute;
            font-size: 70px;
            right: 5%;
            top: 25%;
            justify-content: flex-end;
            text-align: center;
            width: 48%;
            display: flex;
            align-items: center;
        }

        .coupon-amnt img {
            width: 58px;
        }

        .frnt-ref-no {
            position: absolute;
            font-size: 10.5px;
            right: 4%;
            top: 5%;
        }

        .qr-code {
            max-width: 30%;
            position: absolute;
            right: 0;
            left: 0;
            margin: 0 auto;
            top: 4%;
            text-align: center;
        }

        .qr-code svg {
            width: 70%;
            height: auto;
            background: #fff;
            padding: 2px;
        }

        .back-ref-no {
            font-size: 6px;
            text-align: center;
            color: #fff;
        }

        .position-relative {
            position: relative;
        }

        .img-fluid {
            max-width: 100%;
        }

        td {
            float: left;
            margin: 2px;
        }

        .brand-logo-front {
            position: absolute;
            width: 79px;
            max-height: 50px;
            height: auto;
            bottom: 35%;
            left: 4%;
            text-align: center;
        }

        .brand-logo-back {
            position: absolute;
            width: 85px;
            right: 8%;
            top: 17%;
            text-align: center;
        }

        .brand-logo-front img,
        .brand-logo-back img {
            max-width: 100%;
            max-height: 48px;
            height: auto;
            width: auto;
        }
    </style>
</head>

<body>

    <!--	  style="display: block; width: 33.3333%;"-->
    {{-- @php
        $digital = \App\Models\CouponRequest::where('digital')->get();
        if ($digital instanceof \App\Models\CouponRequest) {
            $coupons = Coupon::with(
                [
                    'qr' => function ($query) {
                        $query->where('status', 'active');
                    },
                ],
                'couponRequest.company',
            )
                ->where('coupon_request_id', $id)
                ->get();
        }elseif ($digital->isEmpty()) {
            $coupons = Coupon::with(['qr' => function ($query) {
                $query->where('status', 'active');
            }], 'couponRequest.company')->where('coupon_request_id', $id)->get();
        }
    @endphp --}}



    <table style="width: 723px; margin: auto">
        <tr>
            @foreach ($coupons as $coupon)
                <td width=48% style="display: block;">
                    <div class="position-relative front">
                        {{-- @if($digital) --}}
                        <div class="frnt-ref-no">
                            Ref No: {{ $coupon->coupon_code }}
                        </div>
                        {{-- @endif --}}



                        {{-- <div class="brand-logo-front">
                            <img src="{{ asset($coupon->couponRequest->company->logo) }}" alt="">
                        </div> --}}
                        <div class="coupon-amnt">
                            {{-- <img src="{{ asset('assets') }}/images/Qr/reward-icon.png" alt=""> --}}
                            <div>{{ $coupon->couponRequest->amount }}</div>
                        </div>
                        <img src="{{ asset('assets') }}/images/Qr/vouchure-front.jpg" class="img-fluid">
                    </div>
                    <div class="position-relative back text-center">
                        <div class="brand-logo-back">
                            {{-- <img src="{{ asset($coupon->couponRequest->company->logo) }}" alt=""> --}}
                        </div>
                        <div class="qr-area">
                            <div class="qr-code">
                                {!! QrCode::backgroundColor(255, 225, 225, 0)->generate($coupon->qr[0]->QRCode) !!}

                            </div>
                        </div>
                        <img src="{{ asset('assets') }}/images/Qr/vouchure-back.jpg" class="img-fluid">
                    </div>
                </td>
            @endforeach
        </tr>
    </table>

</body>

</html>

<script>
    print()
</script>
