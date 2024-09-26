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
                                    <h4 class="card-title">Coupons List</h4>
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
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.coupon.view', ['id' => $id]) }}",

                                                    buttons: [{
                                                        extend: 'collection',
                                                        text: 'Export',
                                                        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                        className: 'custom-exp-btn',
                                                    }, ],

                                                    columns: [{
                                                            data: 'coupon_request_id',
                                                            name: 'coupon_request_id',
                                                        },
                                                        {
                                                            data: 'coupon_code',
                                                            name: 'coupon_code',
                                                            render: function(data, type, full, meta) {
                                                                return data +

                                                                '<button class="myInput" onclick="myFunction()"><i class="fas fa-clipboard px-2"></i></button>';
                                                                '<i class="fas fa-clipboard px-2"  onclick="myFunction()"></i>';

                                                            }
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
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'active') {
                                                                    return "<span class='badge bg-success'>Unused</span>";
                                                                } else {
                                                                    return "<span class='badge bg-danger'>Used</span>";
                                                                }
                                                            }
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
    <script>
        function myFunction() {
            var copyText = event.target.parentNode.previousSibling.textContent;
            navigator.clipboard.writeText(copyText.trim());
            alert("Copied the text: " + copyText.trim());
        }
    </script>


@endsection
