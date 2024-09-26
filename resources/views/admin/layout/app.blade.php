<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(optional(DB::table('setting_apps')->first())->favicon_logo) }}" height="" width="" alt="App Logo">
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}"> --}}

    <!-- plugin css -->
    <link href="{{ asset('assets/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/mermaid.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/fontend.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toasted/toastr.min.css')}}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" /> --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

{{-- ----------------------------------------export button css----------------------------------- --}}
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}


{{-- ----------------------------------------export button css----------------------------------- --}}

<!-- Bootstrap SelectPicker CSS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<script src="{{asset('assets/js/method.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/toasted/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/toasted/toastr.min.js')}}"></script>
<!-- Bootstrap and Popper.js JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<!-- Bootstrap SelectPicker JS -->

</head>

<body data-topbar="light">

    @include('admin.layout.header')

    @include('admin.layout.sidebar')

    @yield('content')

    @include('admin.layout.footer')

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  --}}
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('assets/js/metismenujs.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/alertify.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/js/rater.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/wNumb.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/gridjs.umd.js') }}"></script> --}}

    <!-- apexcharts -->
    {{-- <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script> --}}

    <!-- for basic area chart -->
    <script src="{{ asset('assets/js/stock-prices.js') }}"></script>
    <!-- for github style chart -->
    <script src="{{ asset('assets/js/github-data.js') }}"></script>
    <!-- for irregular timeseries chart -->
    <script src="{{ asset('assets/js/irregular-data-series.js') }}"></script>



    <!-- Vector map-->
    {{-- <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/pages/all.init.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets/js/pages/apexcharts-boxplot.init.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets/js/pages/gridjs.init.js') }}"></script> --}}

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     {{-- ---------------start----------- this is use for Export to PDF CSV  file action --}}

     <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


     {{-- ---------------end----------- this is use for Export to PDF CSV  file action --}}

    <script>
         function search_global(search) {
        var url = "{{ route('global.search', ':search') }}";
        url = url.replace(':search', search);

        if (search.length >= 2) {

            $('#all_my_result_div').html('');

            $.ajax({
                beforeSend: function() {
                    $('.ajax-loader').css("visibility", "visible");
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //data: $('#postForm').serialize(),
                url: url,
                method: "POST",
                data: {},
                dataType: 'html',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    // alert('success');
                    // alert(JSON.stringify(data));

                    $('#all_my_result_div').html(data);


                },
                error: function(data) {
                    $('#all_my_result_div').html('');
                    // alert('error');
                    //alert(JSON.stringify(data));



                },
                complete: function() {
                    $('.ajax-loader').css("visibility", "hidden");
                }
            });

        }
    }
    </script>
</body>

</html>
