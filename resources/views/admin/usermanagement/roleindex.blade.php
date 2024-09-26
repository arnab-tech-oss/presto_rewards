@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Role Management')
@section('content')

<div class="main-content">
    <div class="page-content">
        <script>
            @if (Session::has('roll_success'))
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-top-center",
                    "showDuration": "300",
                }
                toastr.info("{{ session('roll_success') }}");
            @endif

            @if (Session::has('roll_delete'))
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('roll_delete') }}");
                @endif
            </script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Role List</h4>
                            </div>

                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('add.role') }}"><i class="mdi mdi-plus me-1"></i> Add Role</a>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="datatable table table-striped table-bordered" id="data">
                                    <thead>
                                        <tr class="ligth">
                                            <th>sys_id</th>
                                            <th>Role Name</th>
                                            <th>Role Description</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('#data').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.role') }}",

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'role_name',
                                                            name: 'role_name',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description'
                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action'
                                                        },
                                                        // Add more columns as needed
                                                    ]
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
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">View Role Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="modal_body">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ---------------------- View Mdal End------------------------------------------------------------- --}}

    {{-- -------------------------------------------Edit Mdal------------------------ --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="edit_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Role Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    {{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}
@endsection
