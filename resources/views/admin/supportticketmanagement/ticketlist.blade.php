@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Ticket')
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

                @if (Session::has('update_success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('update_success') }}");
                @endif
            </script>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Ticket List</h4>
                                </div>
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('admin/tic/post') }}"><i class="mdi mdi-plus me-1"></i> New Ticket</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white"
                                    href="{{ route('admin.catalog.add') }}"><i class="las la-plus mr-3"></i>Add Catalogue</a> --}}
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="arc">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Customer Name</th>
                                                <th>Subject</th>
                                                <th>Ticket No</th>
                                                <th>Status</th>
                                                <th>Registration Date</th>
                                                <th>Mode</th>
                                                <th>Updated on</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('#arc').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.tic.list') }}",
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
                                                            data: 'customer.first_name',
                                                            name: 'customer.first_name',
                                                        },
                                                        {
                                                            data: 'subject',
                                                            name: 'subject'
                                                        },
                                                        {
                                                            data: 'type',
                                                            name: 'type',
                                                            orderable: false,
                                                            searchable: false,
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'close') {
                                                                    return "<span class='badge rounded-pill badge-soft-danger'>Close</span>";
                                                                } else {
                                                                    return "<span class='badge rounded-pill badge-soft-success'>Open</span>";
                                                                }
                                                            }
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
                                                            data: 'mode',
                                                            name: 'mode',
                                                        },
                                                        {
                                                            data: 'updated_at',
                                                            name: 'updated_at',
                                                            render: function(data) {
                                                                return moment(data).format('D-M-YYYY HH:mm:ss');
                                                            }
                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action'
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
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">View Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ---------------------- View Mdal End------------------------------------------------------------- --}}

    {{-- -------------------------------------------Edit Mdal------------------------ --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="edit_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Update Offer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}

@endsection
