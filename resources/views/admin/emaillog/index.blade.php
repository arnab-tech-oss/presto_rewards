@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Email Log')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Email log List</h4>
                                </div>
                                {{-- <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('admin.catalog.add') }}"><i class="mdi mdi-plus me-1"></i> New
                                    Catalogue</a> --}}
                                {{-- <a class="btn btn-primary add-list btn-sm text-white"
                                href="{{ route('admin.catalog.add') }}"><i class="las la-plus mr-3"></i>Add Catalogue</a> --}}
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="abc">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Date</th>
                                                <th>Receiver</th>
                                                <th>Subject</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('#abc').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.email.log') }}",

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
                                                            data: 'date',
                                                            name: 'date',
                                                        },
                                                        {
                                                            data: 'to',
                                                            name: 'to'
                                                        },
                                                        {
                                                            data: 'subject',
                                                            name: 'subject'
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


    {{-- -------------------------------------------View Mdal------------------------ --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">View Mail Details</h5>
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
