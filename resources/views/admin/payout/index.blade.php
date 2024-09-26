@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Payout Request')
@section('content')

    <div class="main-content">
        <div class="page-content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between" style="overflow-y: auto">
                                <div class="header-title">
                                    <h4 class="card-title">Payout Order Details</h4>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="" style="padding: 17px 0 0 17px">
                                                <select class="form-select" id='datastatus' name="datastatus">
                                                    <option value="">Select</option>
                                                    <option value="COMPLETED">COMPLETED</option>
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="FAILED">FAILED</option>
                                                    <option value="INITIATED">INITIATED</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="card-body">
                                        <div class="table-responsive-lg">
                                            <div id="daterange"
                                                style="background: #f8f7fc; cursor: pointer; padding: 5px 10px;

                                            width: fit-content;
                                            margin: 0 auto -35px 320px;
                                            text-align: center;
                                            position: relative;
                                            z-index: 1;
                                           border-radius: 0px 0px 0.25rem 0.25rem;"
                                                onmouseover="this.style.background='#d3d2d6'"
                                                onmouseout="this.style.background='#f8f7fc'">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span></span>
                                                <i class="fas fa-chevron-down"
                                                    style="opacity: .5; font-size: 13px; margin-left: 3px;"></i>
                                            </div>
                                            <table class=" datatable table align-middle table-nowrap table-check">
                                                <tbody>
                                                    <thead>
                                                        <tr class="ligth">
                                                            <th>sys id</th>
                                                            <th>Customer Name</th>
                                                            <th>Phone Number</th>
                                                            <th>Refference No</th>
                                                            <th>Amount</th>
                                                            <th>Payment Req Type</th>
                                                            <th>Upi Id</th>
                                                            <th>Account No</th>
                                                            <th>Transaction Date</th>
                                                            <th>Seq No</th>
                                                            <th>Status</th>
                                                            {{-- <th>message</th> --}}
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <script>
                                                        $(function() {
                                                            var table;
                                                            let start_date = null;
                                                            let end_date = null;

                                                            if (start_date && end_date) {
                                                                $('#daterange span').html(start_date.format('MMMM D, YY') + '-' + end_date.format('MMMM D, YY'));
                                                            } else {
                                                                $('#daterange span').html('Select Date Range');
                                                            }

                                                            $('#daterange').daterangepicker({
                                                                autoUpdateInput: false,
                                                            }, function(start, end) {
                                                                start_date = start;
                                                                end_date = end;

                                                                $('#daterange span').html(start_date.format('MMMM D, YY') + '-' + end_date.format(
                                                                    'MMMM D, YY'));
                                                                table.draw();
                                                            });
                                                            var status = '';

                                                            function initializeDataTable(status) {
                                                                table = $('.datatable').DataTable({
                                                                    processing: true,
                                                                    serverSide: true,
                                                                    ajax: {
                                                                        url: "{{ route('admin.payout') }}",
                                                                        data: function(d) {
                                                                            d.status = status;
                                                                            if (start_date && end_date) {
                                                                                d.from_date = start_date.format('YYYY-MM-DD');
                                                                                d.end_date = end_date.format('YYYY-MM-DD');
                                                                            }
                                                                        }
                                                                    },
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
                                                                            data: 'customer.phone_number',
                                                                            name: 'customer.phone_number',
                                                                        },
                                                                        {
                                                                            data: 'ref_no',
                                                                            name: 'ref_no',
                                                                        },
                                                                        {
                                                                            data: 'amount',
                                                                            name: 'amount',
                                                                        },
                                                                        {
                                                                            data: 'payment_type',
                                                                            name: 'payment_type'
                                                                        },
                                                                        {
                                                                            data: 'upi_id',
                                                                            name: 'upi_id'
                                                                        },
                                                                        {
                                                                            data: 'bank_ac',
                                                                            name: 'bank_ac'
                                                                        },
                                                                        {
                                                                            data: 'created_at',
                                                                            name: 'created_at',
                                                                            render: function(data, type, full, meta) {
                                                                                var date = new Date(data);
                                                                                var formattedDate = date.getFullYear() + '-' +
                                                                                    ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                                                                    ('0' + date.getDate()).slice(-2);

                                                                                // Return the formatted date
                                                                                return formattedDate;
                                                                            }
                                                                        },
                                                                        {
                                                                            data: 'seq_no',
                                                                            name: 'seq_no'
                                                                        },
                                                                        {
                                                                            data: 'status',
                                                                            name: 'status',
                                                                            "render": function(data, type, full, meta) {
                                                                                if (data == 'PENDING') {
                                                                                    return "<span class='badge bg-warning'>Pending</span>";
                                                                                } else if (data == 'COMPLETED') {
                                                                                    return "<span class='badge bg-success'>Completed</span>";
                                                                                } else if (data == 'FAILED') {
                                                                                    return "<span class='badge bg-danger'>Failed</span>";
                                                                                } else {
                                                                                    return "<span class='badge bg-primary'>Initiated</span>";
                                                                                }
                                                                            }

                                                                        },
                                                                        {
                                                                            data: 'action',
                                                                            name: 'action'
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
                                                            }

                                                            initializeDataTable(status);

                                                            $('#datastatus').change(function() {
                                                                status = $(this).val();
                                                                // alert(status);
                                                                table.ajax.reload();
                                                                // initializeDataTable(status);
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
