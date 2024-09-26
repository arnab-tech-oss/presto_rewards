@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Dashboard')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <script>
                @if (Session::has('success'))
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('success') }}");
                @endif
            </script>

<div class="container-fluid">
    <div class="row">
       <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
             <div>
                <h3 class="">Hi, Admin !</h3>
                <h4 class="">Welcome to Presto</h4>
             </div>
          </div>
       </div>
    </div>
    <div class="row row-cols-md-2 row-cols-lg-3" id="dsh-stat-grid">
       <div class="col d-flex">
          <div class="card bg-primary w-100" style="">
             <div class="card-body d-flex justify-content-between">
                <div class="">
                   <h3 class="text-light mb-3">App User</h3>
                   <h5 class="text-light mb-1">{{$report}} User:</h5>
                   <h2 class="mb-3 pt-1 mb-1 text-light">{{$app_user_total}}</h2>
                   <h5 class="text-light mb-1">This Month:</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$app_user_present_month}}</h2>
                   <h5 class="text-light mb-1">Last 7 Days:</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$app_user_last_7_days}}</h2>
                </div>
             <a href="{{route('admin.customerlist')}}"><svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"></path>
                </svg></a>
             </div>
          </div>
       </div>
       <div class="col d-flex">
          <div class="card bg-success w-100" style="">
             <div class="card-body d-flex justify-content-between">
                <div class="">
                   <h3 class="text-light mb-3">Redeemption Pending</h3>
                   <h5 class="text-light mb-1">{{$report}}</h5>
                   <h2 class="mb-3 pt-1 mb-1 text-light">{{$redeempt_pending_total}}</h2>
                   <h5 class="text-light mb-1">Amount</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$redeempt_amount}}</h2>
                </div>
               <a href="{{route('redeemption')}}"><svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"></path>
                </svg></a>
             </div>
          </div>
       </div>
       <div class="col d-flex">
          <div class="card card bg-secondary w-100" style="">
             <div class="card-body d-flex justify-content-between">
                <div class="">
                   <h3 class="text-light mb-3">Payout</h3>
                   <h5 class="text-light mb-1">{{$report}} </h5>
                   <h2 class="mb-3 pt-1 mb-1 text-light">Count:{{$payout_count}} RS:{{$payout_total}}</h2>
                   <h5 class="text-light mb-1">Last Month</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$payout_last_month}}</h2>
                   <h5 class="text-light mb-1">This  Month</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$payout_this_month}}</h2>
                   <h5 class="text-light mb-1">Last 7 Days</h5>
                   <h2 class="pt-1 mb-1 text-light">{{$payout_last_7_days}}</h2>
                </div>
                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"></path>
                </svg>
             </div>
          </div>
       </div>
       {{-- <div class="col">
          <div class="card bg-info" style="">
             <div class="card-body d-flex justify-content-between">
                <div class="">
                   <h3 class="text-light mb-3">Customers</h3>
                   <h5 class="text-light mb-1">Total </h5>
                   <h2 class="mb-3 pt-1 mb-1 text-light">8</h2>
                   <h5 class="text-light mb-1">This Month </h5>
                   <h2 class="pt-1 mb-1 text-light">8</h2>
                </div>
                <svg width="40" clip-rule="evenodd" fill="#fff" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path d="m12.012 1.995c-5.518 0-9.998 4.48-9.998 9.998s4.48 9.998 9.998 9.998 9.997-4.48 9.997-9.998-4.479-9.998-9.997-9.998zm0 1.5c4.69 0 8.497 3.808 8.497 8.498s-3.807 8.498-8.497 8.498-8.498-3.808-8.498-8.498 3.808-8.498 8.498-8.498zm1.528 4.715s1.502 1.505 3.255 3.259c.146.147.219.339.219.531s-.073.383-.219.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.336.217-.527.217-.191-.001-.383-.074-.53-.221-.293-.293-.295-.766-.004-1.057l1.978-1.977h-6.694c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.694l-1.979-1.979c-.289-.289-.286-.762.006-1.054.147-.147.339-.221.531-.222.19 0 .38.071.524.215z" fill-rule="nonzero"></path>
                </svg>
             </div>
          </div>
       </div> --}}
    </div>
 </div>



        </div>
    </div>

@endsection
