@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Category')
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
                                    <h4 class="card-title">Category List</h4>
                                </div>
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    href="{{ route('category.add') }}"><i class="mdi mdi-plus me-1"></i> New Category</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('category.add')}}"><i class="las la-plus mr-3"></i>Add Category</a> --}}
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
                                        <i class="fa fa-caret-down"></i>
                                    </div>
                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
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
                                                        url: "{{ route('category.list') }}",
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
                                                            data: 'name',
                                                            name: 'name',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description'
                                                        },
                                                        {
                                                            data: 'image',
                                                            name: 'image',
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
                    <h5 class="modal-title" id="myLargeModalLabel">View Category</h5>
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
                    <h5 class="modal-title" id="myLargeModalLabel">Update Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit_modal_body">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}


@endsection
