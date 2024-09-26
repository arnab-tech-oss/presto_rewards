
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Recover Password | Vuesy - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"
        media="all" />

        <script src="{{asset('assets/js/toasted/jquery.min.js') }}"></script>

        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toasted/toastr.min.css') }}">

    <script src="{{asset('assets/js/toasted/toastr.min.js') }}"></script>

    </head>

    <body>
        <div class="auth-bg-basic d-flex align-items-center min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 py-5 px-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-5">
                            <div class="text-center text-muted mb-2">
                                <div class="pb-3">
                                    <a href="{{route('admin.dashboard')}}">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="80"> <span class="logo-txt"></span>
                                        </span>
                                    </a>
                                    {{-- <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">User Experience &amp; Interface Design Strategy Saas Solution</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-transparent shadow-none border-0">
                                <div class="card-body">
                                    <div class="py-3">
                                        <div class="text-center">
                                            <h5 class="mb-0">Reset Password</h5>
                                            <p class="text-muted mt-2">Re-Password with Presto.</p>
                                        </div>
                                        <div class="alert font-size-14 alert-success text-center mb-3 mt-5" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>
                                        <form class="mt-3" method="post" action="{{route('paswword.post')}}">
                                            @csrf
                                            <div class="form-floating form-floating-custom mb-3">
                                                <input type="email" class="form-control" id="input-email" name="email" placeholder="Enter Email">
                                                <label for="input-email">Email</label>
                                                <div class="form-floating-icon">
                                                    <i class="uil uil-envelope-alt"></i>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Send Password Reset Link
                                                </button>
                                            </div>
        
                                        </form><!-- end form -->
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0"> {!!optional(DB::table('setting_apps')->first())->footer_left!!} </p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js') }}"></script>

        <script src="{{asset('assets/js/pages/pass-addon.init.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    </body>
</html>
