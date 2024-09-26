<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Sign In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"
        media="all" />

    <script src="assets/js/toasted/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/toasted/toastr.min.css">

    <script src="assets/js/toasted/toastr.min.js"></script>

</head>

<body class="bg-white">

    <div class="auth-page overflow-hidden d-flex align-items-center min-vh-100">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-7">
                    <div class="d-flex flex-column h-100 py-3 px-3 justify-content-between position-relative auth-feat log_in"
                        style="background: url(assets/images/auth-bg.jpg)">
                        <a href="index.html" class="position-relative" style="padding: 0 0 0 15px">
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.png" alt="" height="80">
                            </span>
                        </a>
                        <div class="my-auto position-relative">
                            <div class="" style="padding: 0 0 0 15px">

                                <h1 class="display-4 text-white"><strong>Welcome to PrestoReward</strong> <br />
                                    Write a thank-you note </h1>
                                {{-- <h1 class="display-4 text-dark"><strong>Login to dashboard</strong> <br/>
                                    Write a thank-you note </h1>
                                    <h1 class="display-4 text-dark"><strong>Access you dashboard</strong> <br/>
                                        Write a thank-you note </h1> --}}

                            </div>
                        </div>



                    </div>

                    <!-- end auth full page content -->
                </div>
                <!-- end col -->

                <div class="col-lg-5">
                    <div class="auth-bg bg-light py-md-5 p-4 d-flex">
                        <div class="bg-overlay-gradient">
                            <script>
                                @if (Session::has('password_message'))
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true,
                                        "showDuration": "400",
                                    }
                                    toastr.error("{{ session('password_message') }}");
                                @endif

                                @if (Session::has('message'))
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true,
                                        "showDuration": "300",
                                    }
                                    toastr.info("{{ session('message') }}");
                                @endif

                                @if (Session::has('email_message'))
                                    toastr.options = {
                                        "closeButton": true,
                                        "progressBar": true,
                                        "showDuration": "400",
                                    }
                                    toastr.error("{{ session('email_message') }}");
                                @endif
                            </script>
                        </div>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center g-0 align-items-center w-100">
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100 py-5 px-4 justify-content-between">
                                    <div class="card bg-transparent shadow-none border-0 pb-5">
                                        <div class="card-body">
                                            <a href="index.html" class="position-relative mb-2 d-block text-center">
                                                <span class="logo-lg">
                                                    <img src="assets/images/logo-sm.png" alt="" height="80">
                                                </span>
                                            </a>
                                            <div class="px-3 py-3 pb-0">
                                                <div class="text-center">
                                                    <h2 class="mb-0 mt-3">Welcome Back !</h2>
                                                    <p class="text-muted mt-2">Sign in to Presto Plast.</p>
                                                </div>
                                                <form class="mt-4 pt-2" method="POST"
                                                    action="{{ route('admin.post.login') }}">
                                                    @csrf
                                                    <div class="form-floating form-floating-custom mb-3">
                                                        <input type="text" class="form-control" id="input-username"
                                                            name="email_id" placeholder="Enter User Name" required>
                                                        <label for="input-username">Username</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-users-alt"></i>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                                        <input type="password" class="form-control" id="password-input"
                                                            name="password" placeholder="Enter Password">
                                                        <button type="button"
                                                            class="btn btn-link position-absolute h-100 end-0 top-0"
                                                            id="password-toggle">
                                                            <i
                                                                class="mdi mdi-eye-off-outline font-size-18 text-muted"></i>
                                                        </button>
                                                        <label for="password-input">Password</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-padlock"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-check-primary font-size-16 py-1">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="remember-check">
                                                        {{-- <div class="float-end">
                                                            <a href="{{ route('forgot.password') }}"
                                                                class="text-muted text-decoration-underline font-size-14">Forgot
                                                                your password?</a>
                                                        </div> --}}
                                                        <label class="form-check-label font-size-14"
                                                            for="remember-check">
                                                            Remember me
                                                        </label>
                                                    </div>

                                                    <div class="mt-3">
                                                        <button class="btn btn-primary w-100" type="submit">Log
                                                            In</button>
                                                    </div>

                                                </form><!-- end form -->
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="col-sm-4">
                                            {{optional(DB::table('setting_apps')->first())->footer_left}}
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="text-sm-end d-none d-sm-block">
                                             <div class="footer_privacy_policy">
                                                @foreach(footer_content() as $data)
                                                <a href="{{$data->description}}" class="text-small" target="_blank">{{$data->tittle}}</a> |
                                                @endforeach
                                            </div>
                                            </div>
                                        </div>
                                    </div> --}}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <div style="background: #fff; padding:15px 12px; ">
        <div class="row">
            <div class="col-sm-6 text-center">
                {{-- &copy; <script>document.write(new Date().getFullYear())</script> --}}
                {{-- {{ $x[1]->billing_footer }} --}}

                {!!optional(DB::table('setting_apps')->first())->footer_left!!}

            </div>
            <div class="col-sm-6 text-center">
                <div class="d-none d-sm-block">
                 {{-- {{ $x[1]->billing_footer1 }} --}}
                 <div class="footer_privacy_policy">

                    {{-- <a href="https://www.prestorewardsapp.com/privacy-policy" class="text-small" target="_blank">  {{optional(DB::table('settings')->first())->billing_footer}}</a> |  --}}
                    @foreach(footer_content() as $data)
                    <a href={{ strip_tags($data->description) }} class="text-small" target="_blank">{{$data->tittle}}</a> |
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"> --}}
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <script src="assets/js/pages/pass-addon.init.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


</body>

</html>


{{-- @if (Session::has('password_message'))
    <div class="alert alert-info">{{ Session::get('password_message') }}
    </div>
@endif --}}

{{-- @if (Session::has('email_message'))
    <div class="alert alert-info">{{ Session::get('email_message') }}
    </div>
@endif --}}

{{-- @if (Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif --}}

<script>
    // Get references to the input and the button
    var passwordInput = document.getElementById("password-input");
    var passwordToggle = document.getElementById("password-toggle");

    // Add a click event listener to the button
    passwordToggle.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.innerHTML = '<i class="mdi mdi-eye-off-outline font-size-18 text-muted"></i>';
        } else {
            passwordInput.type = "password";
            passwordToggle.innerHTML = '<i class="mdi mdi-eye-outline font-size-18 text-muted"></i>';
        }
    });

    $('.auth-text-slider').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script>


