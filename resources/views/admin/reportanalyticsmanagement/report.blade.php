@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Offer')
@section('content')


    <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300",
            }
            toastr.success("{{ session('success') }}");
        @endif
    </script>


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active mb-2" id="v-pills-home-tab" data-bs-toggle="pill"
                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                        aria-selected="false" tabindex="-1">Customer</a>
                                    <a class="nav-link n_link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                        aria-selected="false" tabindex="-1">Coupon</a>
                                    <a class="nav-link  n_link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill"
                                        href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                        aria-selected="false" tabindex="-1">Payout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Report List</h4>
                                    {{-- </div>
                                <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.add.offer')}}"><i
                                    class="las la-plus mr-3"></i>Add Offer</a>
                            </div> --}}

                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Select state <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            {{-- <a class="dropdown-item" href="#">Select state</a> --}}
                                            <a class="dropdown-item" href="{{route('report.customer',['id' => 'panjab'])}}">panjab</a>
                                            <a class="dropdown-item" href="{{route('report.customer',['id' => 'west Bengal'])}}">west Bengal</a>
                                            <a class="dropdown-item" href="{{route('report.customer',['id' => 'Andhra Pradesh'])}}">Andhra Pradesh</a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive-lg">
                                            <table class="datatable table align-middle table-nowrap table-check"
                                                id="datatable">
                                                <thead>
                                                    <tr class="ligth">
                                                        <th>Sl No</th>
                                                        <th>Customer Name</th>
                                                        {{-- <th>Bank Payout Per Month</th> --}}

                                                        {{-- <th class="text-center">Action</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $pd)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$pd->customer->first_name}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
            </div>
        @endsection
        