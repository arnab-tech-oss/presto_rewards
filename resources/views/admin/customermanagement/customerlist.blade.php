@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Customer List')
@section('content')

    <div class="main-content">
        <div class="page-content">
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Customer List</h4>
                                </div>
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('customer.add') }}"><i class="mdi mdi-plus me-1"></i> New Customer</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{ route('customer.add') }}"><i class="las la-plus mr-3"></i>Add Customer</a> --}}
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
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
                                        <i class="fas fa-chevron-down" style="opacity: .5; font-size: 13px; margin-left: 3px;"></i>
                                    </div>
                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                {{-- <th>Address</th> --}}
                                                <th>State</th>
                                                <th>Registration Date</th>
                                                {{-- <th>District</th> --}}
                                                {{-- <th>ref code</th> --}}
                                                <th>Last login</th>
                                                <th>Verified</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <script type="text/javascript">
                                                $(function() {

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

                                                    var table = $('.datatable').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax: {
                                                            url: "{{ route('admin.customerlist') }}",
                                                            data: function(data) {
                                                                if (start_date && end_date) {
                                                                    data.from_date = start_date.format('YYYY-MM-DD');
                                                                    data.end_date = end_date.format('YYYY-MM-DD');
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
                                                                data: 'first_name',
                                                                name: 'first_name',
                                                                render: function(data, type, full, meta) {
                                                                    return data + ' ' + full.last_name;
                                                                }
                                                            },
                                                            {
                                                                data: 'phone_number',
                                                                name: 'phone_number'
                                                            },
                                                            {
                                                                data: 'address.customerstate.state',
                                                                name: 'address.customerstate.state',
                                                                defaultContent: 'null'
                                                            },
                                                            {
                                                                data: 'created_at',
                                                                name: 'created_at',
                                                                render: function(data) {
                                                                    return moment(data).format('YYYY-MM-DD HH:mm:ss');
                                                                }
                                                            },
                                                            {
                                                                data: 'last_login',
                                                                name: 'last_login',
                                                                render: function(data, type, full, meta) {
                                                                    if (data === null) {
                                                                        return 'null';
                                                                    } else {
                                                                        return data;
                                                                    }
                                                                }
                                                            },
                                                            {
                                                                data: 'verify',
                                                                name: 'verify',
                                                                "render": function(data, type, full, meta) {
                                                                    if (data.toLowerCase() == 'false') {
                                                                        return "<span class='badge bg-danger'>Not Verified</span>";
                                                                    } else {
                                                                        return "<span class='badge bg-success'>Verified</span>";
                                                                    }
                                                                }

                                                            },
                                                            {
                                                                data: 'status',
                                                                name: 'status'
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

                                                        initComplete: function() {
                                                            var currentUrl = window.location.href;
                                                            var id = currentUrl.split('?')[1];

                                                            $.ajax({
                                                                type: "GET",
                                                                url: '{{ route('customer.search', ':id') }}'.replace(':id', id),
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    //console.log(response.title);
                                                                    var searchInput = $('#datatable_filter input[type="search"]');
                                                                    searchInput.val(response
                                                                        .first_name); // Set the value of the search input field
                                                                    searchInput.trigger('keyup');
                                                                }
                                                            });
                                                        }
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


    {{-- -------------------------------------------View Mdal------------------------ --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Customer View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ---------------------- View Mdal End------------------------------------------------------------- --}}
@endsection
