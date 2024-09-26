<div class="vertical-menu">


    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                 <img src="{{ asset('assets') }}/images/logo-sm.png" alt="" height="26">
            </span>
            <span class="logo-lg">
                {{-- <img src="{{ asset ('images/company/logo-sm.png')}}" alt="" height="80" width="80"> --}}
                <img src="{{ asset(optional(DB::table('setting_apps')->first())->applogo) }}" height="100" width="100" alt="App Logo">
            </span>
        </a>

        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('images') }}/setting/logo-sm.png" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('images') }}/images/setting/logo-sm.png" alt="" height="40">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">For Admin</li>

                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i class="bx bx-home-circle nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.company')}}"  class="">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-company">Brands</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-shield-quarter nav-icon"></i>
                        <span class="menu-item" data-key="t-products">Products</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.catalog')}}">Catalogues</a></li>
                        <li><a href="{{route('admin.product')}}">Products</a></li>
                        <li><a href="{{route('category.list')}}">Categories</a></li>
                        {{-- <li><a href="{{route('product.download')}}">Csv product download</a></li> --}}
                        {{-- <li><a href="{{route('product.upload')}}">Csv product upload</a></li> --}}
                    </ul>

                </li>

                <li>
                    <a href="#" class="has-arrow">
                        <i class="bx bxs-user"></i>
                        <span class="menu-item" data-key="t-customers">Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.customerlist')}}">Customers</a></li>
                        <li><a href="{{route('admin.product.review')}}">Customer/Product Reviews</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-coupon"></i>
                        <span class="menu-item" data-key="t-coupons">Generate Coupons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.coupon.request.list')}}">Coupon List</a></li>
                        <li><a href="{{route('admin.coupon.request.add')}}">Add Coupon Request</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('redeemption')}}" class="">
                        <i class="bx bx-gift"></i>
                        <span class="menu-item" data-key="t-redem">Redemptions Management</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fas fa-wallet"></i>
                        <span class="menu-item" data-key="t-wallets" >Wallets Management</span>
                    </a>

                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.walletmanagement.list')}}">Wallets List</a></li>
                        <li><a href="{{route('admin.all.trans')}}">All Transaction List</a></li>

                    </ul>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-bank"></i>
                        <span class="menu-item" data-key="t-Payout">Payout</span>
                    </a>

                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.payout')}}">Order</a></li>
                        <li><a href="{{route('admin.trans')}}">Transaction</a></li>

                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-user nav-icon"></i>
                        <span class="menu-item" data-key="t-user">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{route('admin.role')}}">Role</a></li>
                         <li><a href="{{route('admin.usermanagement')}}">User</a></li>
                         {{-- <li><a href="">Activity Log</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-chat nav-icon"></i>
                        <span class="menu-item" data-key="t-supports">Support</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.tic.list')}}">Requests</a></li>
                        <li><a href="{{route('admin.support.comment')}}">Comments</a></li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-shield"></i>
                        <span class="menu-item" data-key="t-accounts">Accounts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.payout')}}">Payout Request</a></li>
                            <li><a href="{{route('admin.trans')}}">Transactions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-file nav-icon"></i>
                        <span class="menu-item" data-key="t-marketing">Marketing</span>
                    </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.offer')}}">Offers</a></li>
                        <li><a href="{{route('admin.marketing.tool')}}">Marketing Tools</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-setup">Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- <li><a href="{{route('admin.setting.index')}}">Software</a></li> --}}
                        <li><a href="{{route('admin.app.set')}}">App Setting</a></li>
                        <li><a href="{{route('admin.setting.showdata')}}">CMS Pages</a></li>
                        {{-- <li><a href="{{route('admin.appurl')}}">APP URLS</a></li>
                        <li><a href="">Analytics</a></li> --}}
                    </ul>
                </li>

                 <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-util">Utilities</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        {{-- <li><a href="{{route('admin.appurl')}}">APP">Product Review</a></li>
                        {{-- <li><a href="">Media</a></li> --}}
                        <li><a href="{{route('admin.email.log')}}">Email Logs</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-briefcase-alt-2 nav-icon"></i>
                        <span class="menu-item" data-key="t-anal">Reports & Analytics</span>
                    </a>
                     <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.analytics')}}">Analytics</a></li>
                        <li><a href="{{route('admin.report.list')}}">Report List</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
