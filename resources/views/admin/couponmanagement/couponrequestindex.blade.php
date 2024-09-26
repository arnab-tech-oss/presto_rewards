@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Coupon Management')
@section('content')
    <script>
        function Downloadpdf(url) {
            alert(url);
            window.open(url, "", "width=800, height=500");

        }
    </script>
    <div class="main-content">
        <div class="page-content">
            <script>
                @if (session()->has('success'))
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
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Coupon Generation List</h4>
                                </div>

                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('admin.coupon.request.add') }}"><i class="mdi mdi-plus me-1"></i>
                                    Generate Coupons</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{ route('admin.coupon.request.add') }}"><i
                                        class="las la-plus mr-3"></i>Generate Coupon</a> --}}
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table   table-striped table-bordered ">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>No of coupons</th>
                                                <th>Coupon Amount</th>
                                                {{-- <th>Brand Name</th> --}}
                                                <th>Generation Date</th>
                                                <th>Expiry Date</th>
                                                <th>Description</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Action</th>
                                                {{-- <th class="text-center">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($couponRequest as $cRequest)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $cRequest->no_of_coupons }}</td>
                                                    <td>{{ $cRequest->amount }}</td>
                                                    <td>{{ $cRequest->company->company_name }}</td>
                                                    <td>{{ $cRequest->expiry_date }}</td>
                                                    <td>{{ $cRequest->status }}</td>
                                                    <td>
                                                        <a class="btn btn-primary add-list btn-sm text-white" href="{{ route('admin.coupon.view', [$cRequest->id]) }}"><i
                                                            class="las la-plus mr-3"></i>View Coupons</a>
                                                           <a   class="btn btn-primary add-list btn-sm text-white" onclick="window.open('{{ route('admin.coupon.pdf', [$cRequest->id]) }}', '_blank'); return false;"><i
                                                                class="las la-plus mr-3"></i>Download QR</a>
                                                        {{-- <a   class="btn btn-primary add-list btn-sm text-white" href="{{ route('admin.coupon.qr.download', [$cRequest->id]) }}"  >
                                                            <i  class="las la-plus mr-3"></i>Download</a> --}}
                                            {{-- </td>

                                                </tr>
                                            @endforeach --}}
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
    <script type="text/javascript">
        $(function() {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.coupon.request.list') }}",
                order:[
                    [0, 'desc']
                ],

                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                    className: 'custom-exp-btn',
                }, ],


                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'coupon_no',
                        name: 'coupon_no',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                    },
                    // {
                    //     data: 'company.company_name',
                    //     name: 'company.company_name',
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return moment(data).format('D-M-YYYY');
                        }
                    },
                    {
                        data: 'expiry_date',
                        name: 'expiry_date',
                        render: function(data) {
                            return moment(data).format('D-M-YYYY');
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    },
                    // Add more columns as needed
                ],
                colReorder: true,
                dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 100]
                ],
                select: true,
            });
        });
    </script>
@endsection
