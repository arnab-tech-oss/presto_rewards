@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Users Management')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <script>
                @if (Session::has('adduser'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar" : true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.info("{{ session('adduser') }}");
                @endif

                @if (Session::has('update_success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar" : true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.info("{{ session('update_success') }}");
                @endif

            </script>
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Admin User List</h4>
                            </div>
                            {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('user.add')}}"><i
                                    class="las la-plus mr-3"></i>Add User</a> --}}
                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{route('user.add')}}"><i class="mdi mdi-plus me-1"></i>Add User</a>        
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>sys_id</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Role</th>
                                            {{-- <th>Company</th> --}}
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.usermanagement') }}",

                                                    buttons: [
                                                        {
                                                             extend: 'collection',
                                                             text:    'Export',
                                                             buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                             className: 'custom-exp-btn',
                                                        },
                                                    ],

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'full_name',
                                                            name: 'full_name',
                                                        },
                                                        {
                                                            data: 'email',
                                                            name: 'email',
                                                        },
                                                        {
                                                            data: 'user_type',
                                                            name: 'user_type'
                                                        },
                                                        {
                                                            data: 'role.role_name',
                                                            name: 'role.role_name'
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
                                                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
                                                    select: true,
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
        </div>
    </div>
    </div>

     {{-- -------------------------------------------View Mdal------------------------ --}}
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">View USer</h5>
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
                    <h5 class="modal-title" id="myLargeModalLabel">Update USer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">
                   
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
{{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}

@endsection

{{-- @if (session()->has('success'))
  <div class="alert alert-success">
    <!-- {{ session()->get('success') }} -->
    <script>
      alert("Role added successfully")
    </script>
  </div>
@endif  --}}

{{-- @if (session()->has('adduser'))
  <div class="alert alert-success">
    <!-- {{ session()->get('success') }} -->
    <script>
      alert("User added successfully")
    </script>
  </div>
@endif  --}}
