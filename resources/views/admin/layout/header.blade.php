
<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                           
                            <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="26">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets') }}/images/logo-lg.png" alt="" height="26">
                        </span>
                    </a>

                    <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="26">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets') }}/images/logo-lg-wh.svg" alt="" height="26">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn noti-icon">
                    <i class="fa fa-fw fa-bars font-size-16"></i>
                </button>

                {{-- <form id="global_search_form" class="app-search d-none d-lg-block" method="POST">
                    <div class="position-relative">
                        <input name="data" type="search" onkeyup="selectDrop('global_search_form','{{ route('global.search') }}', 'global_search_data')" class="form-control" placeholder="Search...">
                        @csrf
    
                        <span class="bx bx-search icon-sm"></span>
                    </div>
                </form> --}}
                <div class="app-search">
                <div class="position-relative">
                    <input name="data" type="search" onkeyup="search_global(this.value);" class="form-control" placeholder="Search...">
                   

                    <span class="bx bx-search icon-sm"></span>
                </div>
                </div>
                <div id="global_search_data" class="global-search-data custom-scroll-ui">

                    <div class="scroll-y mh-200px mh-lg-325px" id="all_my_result_div">
                                     
                        <!--begin::Item-->
                       
                        <!--end::Item-->
                    </div>
                </div>
                

            </div>

            <div class="d-flex">
                <div class="dropdown d-inline-block d-block d-lg-none">
                    <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search icon-sm"></i>
                    </button>
                    {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <form class="p-2">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control rounded bg-light border-0"
                                        placeholder="Search...">
                                    <i class="bx bx-search search-icon"></i>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>


                 <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell icon-sm"></i>
                        <span class="noti-dot bg-danger rounded-pill">{{ notification()['notifi'] }}</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col" style="text-align: center">
                                    <h5 class="m-0 font-size-15"> Notifications </h5>
                                </div>
                                {{-- <div class="col-auto">
                                    <a href="javascript:void(0);" class="small" onclick="notification('{{route('admin.notification')}}')"> Mark all as read</a>
                                </div> --}}
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 250px;">
                            {{-- <h6 class="dropdown-header bg-light">New</h6> --}}
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex border-bottom align-items-start">
                                    {{-- <div class="flex-shrink-0">
                                        <img src="{{ asset('assets') }}/images/users/avatar-3.jpg"
                                            class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                    </div> --}}
                                    <div class="flex-grow-1 bg-light" style="text-align: center">
                                        {{-- <h6 class="mb-1">Justin Verduzco</h6> --}}
                                        <table id="datatable">
                                        <div class="text-muted">
                                            @foreach (notify() as $notim) 
                                            <tr>
                                                    <p class="mb-0 font-size-13" style="padding: 10px 0 0 0">{{$notim->message}}</p>
                                                    <p class="mb-0 font-size-10 text-uppercase fw-bold " style="border-bottom: 1px solid #dbd4d4; padding: 0 0 10px 0;"></p>
                                                        {{-- @php
                                                            $createdAt = $notim->created_at;
                                                            $diff = now()->diff($createdAt);
                                                            $days = $diff->days;
                                                            $hours = $diff->h;
                                                            $minutes = $diff->i;
                                                        @endphp
                                                    <p class="mb-0 font-size-10 text-uppercase fw-bold " style="border-bottom: 1px solid #dbd4d4; padding: 0 0 10px 0;"><i
                                                    class="mdi mdi-clock-outline"></i>{{$days}} days {{$hours}} hours {{$minutes}} minutes ago</p> --}}
                                            </tr>        
                                            @endforeach
                                        </div>
                                    </table>
                                    </div>
                                </div>
                            </a>           
                        </div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center"
                                href="{{route('admin.notification.list')}}">
                                <span>View More..</span><i class="uil-arrow-circle-right me-1"></i> 
                            </a>
                        </div>
                    </div>
                </div>

                <!--
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                            <i class="bx bx-cog icon-sm"></i>
                        </button>
                    </div>                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                            <i class="bx bx-cog icon-sm"></i>
                        </button>
                    </div>
-->

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item user text-start d-flex align-items-center"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('assets') }}/images/users/avatar-3.jpg.svg" alt="Header Avatar">
                        <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                            <span class="user-name">{{ auth()->user()->full_name }}<i
                                    class="mdi mdi-chevron-down"></i></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <h6 class="dropdown-header">Welcome {{ auth()->user()->full_name }} !</h6>
                        <a class="dropdown-item" href="{{ route('admin.view.index') }}"><i
                                class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Profile</span></a>
                        <!-- <a class="dropdown-item" href="apps-chat.html"><i -->
                        <!-- class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> -->
                        <!-- <span class="align-middle">Messages</span></a> -->
                        <!-- <a class="dropdown-item" href="apps-kanban-board.html"><i -->
                        <!-- class="mdi mdi-calendar-check-outline text-muted font-size-16 align-middle me-1"></i> -->
                        <!-- <span class="align-middle">Taskboard</span></a> -->
                        <!-- <a class="dropdown-item" href="pages-faqs.html"><i -->
                        <!-- class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span -->
                        <!-- class="align-middle">Help</span></a> -->
                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <a class="dropdown-item d-flex align-items-center" href="contacts-settings.html"><i -->
                        <!-- class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span -->
                        <!-- class="align-middle">Settings</span><span -->
                        <!-- class="badgebg-success-subtle text-success ms-auto">New</span></a> -->
                        <!-- <a class="dropdown-item" href="auth-lockscreen-cover.html"><i -->
                        <!-- class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span -->
                        <!-- class="align-middle">Lock screen</span></a> -->
                        <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="collapse  verti-dash-content" id="dashtoggle">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 sub-title">Quick Report</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0 ">
                                    <li class="breadcrumb-item page-head"><a href="javascript: void(0);">layouts</a>
                                    </li>
                                    <li class="breadcrumb-item page-head active">Vertical</li>
                                </ol>
                            </div> --}}

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- start dash info -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card dash-header-box shadow-none border-0">
                            <div class="card-body p-0">
                                <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                    <div class="col">
                                        <div class="mt-md-0 py-3 px-4 mx-2">
                                            <p class="text-white-50 mb-2 text-truncate">Customers <span>Total</span>
                                            </p>
                                            <h3 class="text-white mb-0">{{ quickreport()['customer'] }}</h3>
                                        </div>
                                    </div><!-- end col -->

                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">



                                            <p class="text-white-50 mb-2 text-truncate">Total Generate Coupun</p>

                                            <h3 class="text-white mb-0">{{ quickreport()['generated_coupon'] }}</h3>
                                        </div>
                                    </div><!-- end col -->

                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                            <p class="text-white-50 mb-2 text-truncate">Coupon Redeemed</p>
                                            <h3 class="text-white mb-0">{{ quickreport()['total_redeemed'] }}</h3>
                                        </div>
                                    </div><!-- end col -->

                                    <div class="col">
                                        <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                            <p class="text-white-50 mb-2 text-truncate">Customers <span>New</span></p>
                                            <h3 class="text-white mb-0">{{ quickreport()['new_customer'] }}</h3>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                            <p class="text-white-50 mb-2 text-truncate">Daily Average Income</p>
                                            <h3 class="text-white mb-0"></h3>
                                        </div>
                                    </div><!-- end col -->

                                    <div class="col">
                                        <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                            <p class="text-white-50 mb-2 text-truncate">Annual Deals</p>
                                            <h3 class="text-white mb-0"></h3>
                                        </div>
                                    </div><!-- end col -->

                                </div><!-- end row -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
                <!-- end dash info -->
            </div>
        </div>

        <!-- start dash troggle-icon -->
        {{-- <div>
            <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle"
                aria-expanded="true" aria-controls="dashtoggle">
                <i class="bx bx-up-arrow-alt"></i>
            </a>
        </div> --}}
        <!-- end dash troggle-icon -->
    </header>
    <script>
      function notification(url)
        {
            if (confirm("Are you sure to Read all notification ?")) {
                 $.ajax({
                 url: url,
                 type: 'GET',
                 success: function(response) {
                 // Handle the response here, e.g., update button text or styles
                 $('#'+targetId).html(response);
                 $('#datatable').ajax.reload();
                },
              error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
          });
         }
        }

      
    </script>
    {{-- <script>
        $(document).ready(function() {
           
            $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

            $('#searchQuery').keyup(function() {
                var searchQuery = $('#searchQuery').val();

                $.ajax({
                    url: '{{ route('admin.product.lists') }}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        'searchQuery': searchQuery, // Fix the syntax error here (removed semicolon)
                    },
                    success: function(response) {
                        // Assuming you have an element with id 'book_list' to update with the response
                        // $('#book_list').html(response);
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            // Bind an event handler to the search input
            $('#searchInput').on('input', function() {
                var searchQuery = $(this).val();
                fetchBooks(searchQuery);
            });
        });
    </script> --}}
