@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Customer Enquiry')
@section('content')

    <style>
        tr.bg-danger td {
            --bs-table-accent-bg: #f72d2da5 !important;
        }
    </style>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Customer Query</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table table-striped table-bordered" id="arc">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Customer Name</th>
                                                <th>Subject</th>
                                                <th>Ticket No</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <script type="text/javascript">
                                                $(function() {
                                                    var table = $('#arc').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax: "{{ route('admin.support.comment') }}",

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
                                                                data: 'customer.first_name',
                                                                name: 'customer.first_name',
                                                            },
                                                            {
                                                                data: 'subject',
                                                                name: 'subject'
                                                            },
                                                            {
                                                                data: 'ticket_no',
                                                                name: 'ticket_no',
                                                            },
                                                            {
                                                                data: 'created_at',
                                                                name: 'created_at',
                                                                render: function(data) {
                                                                    return moment(data).format('YYYY-MM-DD HH:mm:ss');
                                                                }
                                                            },
                                                            {
                                                                data: 'status',
                                                                name: 'status'
                                                            },
                                                            {
                                                                data: 'action',
                                                                name: 'action'
                                                            },
                                                            // Add more columns as needed
                                                        ],

                                                        colReorder: true,
                                                        dom: 'lBfrtip',
                                                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
                                                        select: true,
                                                        
                                                        rowCallback: function(row, data, index) {
                                                            var createdDate = moment(data.updated_at);
                                                            var currentDate = moment();
                                                            if (currentDate.diff(createdDate, 'hours') > 48 && data.reply_by.toLowerCase() ===
                                                                'customer') {
                                                                $(row).addClass('bg-danger'); // Add CSS class to highlight row
                                                            }
                                                        },
                                                    });
                                                });
                                            </script>
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
