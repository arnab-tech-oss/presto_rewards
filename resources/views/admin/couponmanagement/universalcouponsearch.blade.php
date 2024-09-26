@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Coupon Management')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <script></script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Coupon List</h4>
                                </div>


                                <a class="btn btn-primary add-list btn-sm text-white"
                                    href="{{ route('admin.coupon.request.list') }}">
                                    <i class="las la-plus mr-3"></i>Back to Coupon Request List</a>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">
                                                <th>Req Id</th>
                                                <th>Coupon Code</th>
                                                <th>Coupon Amount</th>
                                                <th>Company Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <script type="text/javascript">
                                            var currentUrl = window.location.href;
                                            var segments = currentUrl.split('/');
                                            var id = segments[segments.length - 1];
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('coupon.search', ':id') }}".replace(':id', id),

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
                                                            data: 'coupon_code',
                                                            name: 'coupon_code',
                                                        },
                                                        {
                                                            data: 'coupon_request.amount',
                                                            name: 'coupon_request.amount'
                                                        },
                                                        {
                                                            data: 'coupon_request.company.company_name',
                                                            name: 'coupon_request.company.company_name'
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status'
                                                        },
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
