@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Offer')
@section('content')


<script>
  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true,
    "positionClass": "toast-top-center",
    "showDuration": "300",
  }
  		toastr.success("{{ session('success') }}");
  @endif
</script>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                    <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Offer List</h4>
                                </div>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.add.offer')}}"><i
                                    class="las la-plus mr-3"></i>Add Page</a> --}}
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{route('admin.add.offer')}}"><i class="mdi mdi-plus me-1"></i>Add Offer</a>
                            </div>

                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>sys_id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Banner</th>
                                            <th>Cta_Type</th>
                                            <th>Action_link</th>
                                            <th>Time Left</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>


                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.offer') }}",

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
                                                            data: 'title',
                                                            name: 'title',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description',
                                                        },
                                                        {
                                                            data: 'baner',
                                                            name: 'baner',
                                                            orderable: false,
                                                            searchable: false,
                                                            render: function(data, type, full, meta) {
                                                                // Assuming 'logo' contains the image URL, render it as an image tag
                                                                return '<img src="' + data +
                                                                    '" alt="Logo"  class="img-fluid" style="width:50px">';
                                                            }
                                                        },
                                                        {
                                                            data: 'cta_type',
                                                            name: 'cta_type'
                                                        },
                                                        {
                                                            data: 'action_link',
                                                            name: 'action_link'
                                                        },
                                                        {
                                                            data: 'end_date',
                                                            name: 'end_date'
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
                                                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">View Offer</h5>
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
