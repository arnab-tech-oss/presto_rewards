@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Company Management')
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
                                    <h4 class="card-title">Brand List</h4>
                                </div>

                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"  href="{{ route('company.add') }}"><i class="mdi mdi-plus me-1"></i> New Brand</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{ route('company.add') }}"><i
                                        class="las la-plus mr-3"></i>Add Company</a> --}}
                            </div>

                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class="datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">

                                                <th>SYS ID</th>
                                                <th>Brand Name</th>
                                                <th>Brand Title</th>
                                                <th>Logo</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.company') }}",

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
                                                            data: 'company_name',
                                                            name: 'company_name',
                                                        },
                                                        {
                                                            data: 'brand_title',
                                                            name: 'brand_title'
                                                        },
                                                        {
                                                            data: 'logo',
                                                            name: 'logo',
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
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false,
                                                        },
                                                      
                                                    ],
                                                        colReorder: true,
                                                        dom: 'lBfrtip',
                                                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
                                                        select: true,

                                                        initComplete: function() {
                                                        var currentUrl = window.location.href;
                                                        var id = currentUrl.split('?')[1];

                                                        $.ajax({
                                                            type: "GET",
                                                            url: '{{ route('comapany.search', ':id') }}'.replace(':id', id),
                                                            dataType: "json",
                                                            success: function(response) {
                                                                //console.log(response.title);
                                                                var searchInput = $('#datatable_filter input[type="search"]');
                                                                searchInput.val(response
                                                                    .company_name); // Set the value of the search input field
                                                                searchInput.trigger('keyup');
                                                            }
                                                        });
                                                    }
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
        <div class="modal-header pb-0">
            <h5 class="modal-title" id="myLargeModalLabel">View Brand</h5>
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
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="myLargeModalLabel">Update Brand Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit_modal_body">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

{{-- ---------------------- Edit Mdal End------------------------------------------------------------- --}}

@endsection
{{-- <tbody>
@foreach ($company as $entry)
<tr>
<td>{{$loop->iteration}}</td>
<td>{{$entry->company_name}}</td>
<td>{{$entry->brand_title}}</td>
<td><img src="{{asset($entry->logo)}}" alt="Image" class="img-fluid rounded" style="width:50px;"></td>
<td>{{$entry->status}}</td>
<td class="text-center">
<!-- Add action buttons here -->
<a href="{{route('admin.company.edit',[$entry->id])}}" class="btn btn-primary btn-sm"><i
class="fas fa-edit"></i> Edit</a>
@if ($entry->status == 'active')
<a href="{{route('company.status',[$entry->id])}}" class="btn btn-danger btn-sm delete-btn" id="deleteRoleBtn"><i class="fas fa-ban"></i> Deactivate</a>  
@else
<a href="{{route('company.status',[$entry->id])}}" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i>Activate</a>
@endif
<script>
$(document).ready(function() {
$('.delete-btn').on('click', function(e) {
e.preventDefault();
// Show a custom confirmation dialog
var confirmation = window.confirm('Are you sure you want to deactivate this company?');
// If user confirms, navigate to the delete URL
if (confirmation) {
var url = $(this).attr('href');
window.location.href = url;
}
});
});
</script>
</td>
</tr>
@endforeach
</tbody> --}}