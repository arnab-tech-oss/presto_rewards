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
            font-size: 30px;
            right: 0;
            bottom: 0;
            justify-content: center;
            text-align: center;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .coupon-amnt img {
            width: 26px;
        }

        .frnt-ref-no {
            position: absolute;
            font-size: 8.5px;
            bottom: 27%;
            width: 100%;
            text-align: center;
        }

        .qr-code {
            max-width: 98%;
            position: absolute;
            right: 0;
            left: 0;
            margin: 0 auto;
            top: 12%;
            text-align: center;
        }

        .qr-code svg {
            width: 70%;
            height: auto;
            background: #fff;
            padding: 2px;
            border: 1px solid #5d4d9f;
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
            margin: 0 2px;
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

    <table style="width: 723px; margin: auto">
        <tr>

            @foreach ($coupons as $coupon)
                <td width=13.2% style="display: block;">
                    <div class="position-relative front">
                        <img src="{{ asset('assets/images/Qr/Coupon-Digital.jpg') }}" alt="" width="100%">
                        <div class="qr-area">
                            <div class="qr-code">
                                <?xml version="1.0" encoding="UTF-8"?>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100" height="100"
                                    viewBox="0 0 100 100">
                                    <g transform="scale(3.448)">
                                        <g transform="translate(0,0)">
                                            <path fill-rule="evenodd"
                                                d="M9 0L9 1L11 1L11 2L9 2L9 3L8 3L8 5L9 5L9 6L8 6L8 7L9 7L9 9L10 9L10 10L8 10L8 8L5 8L5 10L4 10L4 9L2 9L2 8L0 8L0 9L2 9L2 10L1 10L1 11L0 11L0 13L1 13L1 14L0 14L0 21L1 21L1 19L2 19L2 18L3 18L3 17L4 17L4 16L6 16L6 17L5 17L5 18L4 18L4 19L5 19L5 20L2 20L2 21L8 21L8 24L9 24L9 27L8 27L8 29L9 29L9 27L10 27L10 24L9 24L9 20L11 20L11 21L10 21L10 23L11 23L11 21L12 21L12 22L13 22L13 23L12 23L12 24L11 24L11 25L14 25L14 23L15 23L15 25L16 25L16 26L15 26L15 28L17 28L17 27L16 27L16 26L19 26L19 27L20 27L20 28L18 28L18 29L20 29L20 28L21 28L21 29L22 29L22 28L23 28L23 29L24 29L24 27L25 27L25 28L26 28L26 29L27 29L27 27L28 27L28 28L29 28L29 27L28 27L28 26L29 26L29 25L28 25L28 23L27 23L27 24L26 24L26 23L25 23L25 20L22 20L22 19L24 19L24 18L25 18L25 19L26 19L26 18L27 18L27 16L28 16L28 19L27 19L27 20L26 20L26 22L27 22L27 21L28 21L28 22L29 22L29 21L28 21L28 20L29 20L29 16L28 16L28 15L27 15L27 14L29 14L29 12L28 12L28 11L27 11L27 12L28 12L28 13L26 13L26 11L25 11L25 9L26 9L26 10L28 10L28 9L26 9L26 8L24 8L24 11L23 11L23 12L20 12L20 11L18 11L18 10L19 10L19 9L18 9L18 8L17 8L17 6L16 6L16 8L13 8L13 6L12 6L12 9L13 9L13 10L11 10L11 8L10 8L10 7L11 7L11 4L12 4L12 5L14 5L14 7L15 7L15 5L14 5L14 3L15 3L15 4L16 4L16 3L15 3L15 2L14 2L14 3L13 3L13 4L12 4L12 2L13 2L13 1L12 1L12 0ZM14 0L14 1L16 1L16 0ZM18 0L18 1L17 1L17 2L18 2L18 1L19 1L19 0ZM20 1L20 3L19 3L19 5L20 5L20 7L21 7L21 1ZM9 3L9 5L10 5L10 3ZM17 3L17 4L18 4L18 3ZM9 6L9 7L10 7L10 6ZM18 6L18 7L19 7L19 6ZM16 8L16 11L17 11L17 16L16 16L16 15L15 15L15 16L16 16L16 17L17 17L17 16L18 16L18 15L19 15L19 16L20 16L20 17L18 17L18 18L17 18L17 19L16 19L16 20L18 20L18 18L21 18L21 19L20 19L20 20L19 20L19 21L16 21L16 24L19 24L19 23L20 23L20 22L19 22L19 21L20 21L20 20L21 20L21 19L22 19L22 18L24 18L24 17L26 17L26 16L24 16L24 15L25 15L25 14L24 14L24 13L25 13L25 12L23 12L23 14L21 14L21 13L20 13L20 12L18 12L18 11L17 11L17 8ZM6 9L6 10L7 10L7 9ZM21 9L21 11L22 11L22 9ZM2 10L2 11L1 11L1 13L2 13L2 11L3 11L3 10ZM10 10L10 11L8 11L8 12L7 12L7 11L4 11L4 12L3 12L3 14L1 14L1 15L2 15L2 16L1 16L1 17L2 17L2 16L4 16L4 12L5 12L5 13L6 13L6 14L7 14L7 15L6 15L6 16L7 16L7 15L9 15L9 16L10 16L10 17L8 17L8 18L7 18L7 17L6 17L6 18L7 18L7 19L6 19L6 20L7 20L7 19L8 19L8 20L9 20L9 19L12 19L12 21L15 21L15 20L14 20L14 19L15 19L15 17L12 17L12 15L13 15L13 16L14 16L14 13L16 13L16 12L14 12L14 11L15 11L15 10L13 10L13 11L12 11L12 12L11 12L11 16L10 16L10 14L8 14L8 13L9 13L9 12L10 12L10 11L11 11L11 10ZM6 12L6 13L7 13L7 12ZM12 13L12 14L13 14L13 13ZM20 14L20 15L21 15L21 14ZM23 16L23 17L24 17L24 16ZM10 17L10 18L11 18L11 17ZM12 18L12 19L14 19L14 18ZM21 21L21 24L24 24L24 21ZM18 22L18 23L19 23L19 22ZM22 22L22 23L23 23L23 22ZM20 25L20 26L21 26L21 28L22 28L22 27L24 27L24 26L25 26L25 27L26 27L26 26L25 26L25 25L24 25L24 26L23 26L23 25L22 25L22 26L21 26L21 25ZM27 25L27 26L28 26L28 25ZM11 26L11 28L10 28L10 29L12 29L12 27L13 27L13 26ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM22 0L22 7L29 7L29 0ZM23 1L23 6L28 6L28 1ZM24 2L24 5L27 5L27 2ZM0 22L0 29L7 29L7 22ZM1 23L1 28L6 28L6 23ZM2 24L2 27L5 27L5 24Z"
                                                fill="#000000" />
                                        </g>
                                    </g>
                                </svg>



                            </div>
                        </div>
                        <div class="frnt-ref-no">
                            Ref No: {{ $coupon->coupon_code }}
                        </div>
                        <div class="coupon-amnt">
                            <img src="{{ asset('assets/images/Qr/reward-icon.png') }}" alt="">
                            <div>{{ $coupon->couponRequest->amount }}</div>
                        </div>

                        <div class="qr-area">
                            <div class="qr-code">
                                {!! QrCode::backgroundColor(255, 225, 225, 0)->generate($coupon->qr[0]->QRCode) !!}

                            </div>
                        </div>

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
