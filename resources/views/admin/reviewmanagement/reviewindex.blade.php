@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Redeemption')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Review Approval List</h4>
                                </div>
                            </div>



                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class="datatable table   table-striped table-bordered " style="width: 100%">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Review Rating</th>
                                                <th>Review Message</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.product.review') }}",
                                                    order: [
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
                                                            data: 'scale',
                                                            name: 'scale',
                                                        },
                                                        {
                                                            data: 'reviewtext',
                                                            name: 'reviewtext',
                                                        },
                                                        {
                                                            data: 'customer.first_name',
                                                            name: 'customer.first_name',
                                                        },
                                                        {
                                                            data: 'productreview.product_name',
                                                            name: 'productreview.product_name',
                                                        },
                                                        {
                                                            data: 'created_at',
                                                            name: 'created_at',
                                                            render: function(data, type, full, meta) {
                                                                return moment(data).format('MMMM Do YYYY, h:mm:ss a');
                                                            }
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'pending') {
                                                                    return "<span class='badge bg-primary'>Pending</span>";
                                                                } else if (data.toLowerCase() == 'reject') {
                                                                    return "<span class='badge bg-danger'>Rejected</span>";
                                                                } else {
                                                                    return "<span class='badge bg-success'>Approved</span>";
                                                                }
                                                            }

                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false,
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
