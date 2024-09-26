@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', $page)
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
                                    <h4 class="card-title">Catelog List</h4>
                                </div>
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('admin.catelogadd') }}"><i class="mdi mdi-plus me-1"></i> New Catelog</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('category.add')}}"><i class="las la-plus mr-3"></i>Add Category</a> --}}
                            </div>

                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>File</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <script type="text/javascript">
                                            $(function() {
                                                let table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: {
                                                        url: "{{ route('admin.catalog') }}"
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
                                                            data: 'name',
                                                            name: 'name',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description'
                                                        },
                                                        {
                                                            data: 'cover_picture',
                                                            name: 'cover_picture',
                                                            orderable: false,
                                                            searchable: false,
                                                            render: function(data, type, full, meta) {
                                                                // Assuming 'logo' contains the image URL, render it as an image tag
                                                                return '<img src="' + data +
                                                                    '" alt="Logo"  class="img-fluid" style="width:50px">';
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ------------------------------------ VIEW MODAL  ------------------------------------------- --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">View Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ------------------------------------ END MODAL  ----------------------------------------------- --}}


    {{-- ------------------------------------ EDIT MODAL  ----------------------------------------------- --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="edit_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Catalogue Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ------------------------------------ EDIT MODAL  ----------------------------------------------- --}}
@endsection
