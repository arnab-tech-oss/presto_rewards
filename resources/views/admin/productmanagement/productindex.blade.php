@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Product Management')
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

                @if (Session::has('status_change'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('status_change') }}");
                @endif
            </script>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Product List</h4>
                                </div>
                                <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"  href="{{ route('admin.add.product') }}"><i class="mdi mdi-plus me-1"></i> New Product</a>
                                {{-- <a class="btn btn-primary add-list btn-sm text-white"
                                    href="{{ route('admin.add.product') }}"><i class="las la-plus mr-3"></i>Add Product</a> --}}
                            </div>

                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Product Name</th>
                                                <th>Brand Name</th>
                                                {{-- <th>Description</th> --}}
                                                <th>Image</th>
                                                <th>Category Name</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.product') }}",

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
                                                            data: 'product_name',
                                                            name: 'product_name',
                                                        },
                                                        {
                                                            data: 'company.company_name',
                                                            name: 'company.company_name',
                                                        },
                                                        // {
                                                        //     data: 'description',
                                                        //     name: 'description'
                                                        // },
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
                                                            data: 'category.name',
                                                            name: 'category.name',
                                                            orderable: false,
                                                            searchable: false,
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

                                                        initComplete: function() {
                                                        var currentUrl = window.location.href;
                                                        var id = currentUrl.split('?')[1];


                                                        // Log the extracted ID to the console
                                                        //console.log('Extracted ID:', id);
                                                        //for global search

                                                        $.ajax({
                                                            type: "GET",
                                                            url: '{{ route('product.search', ':id') }}'.replace(':id', id),
                                                            dataType: "json",
                                                            success: function(response) {
                                                                //console.log(response.title);
                                                                var searchInput = $('#datatable_filter input[type="search"]');
                                                                searchInput.val(response
                                                                    .product_name); // Set the value of the search input field
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">View Product</h5>
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
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="edit_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Update Product Details</h5>
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
    @foreach ($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->product_name }}</td>
            <td>{{ $data->description }}</td>
            <td><img src="{{ asset($data->image) }}" alt="Image"
                    class="img-fluid rounded" style="width:50px;"></td>
            <td>{{ $data->status }}</td>
            <td class="text-center">
                <!-- Add action buttons here -->
                <a href="{{ route('product.edit', [$data->id]) }}"
                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                    Edit</a>
                @if ($data->status == 'active')
                    <a href="{{ route('product.status', [$data->id]) }}"
                        class="btn btn-danger btn-sm delete-btn"><i
                            class="fas fa-ban"></i>
                        Deactivate</a>
                @else
                    <a href="{{ route('product.status', [$data->id]) }}"
                        class="btn btn-danger btn-sm"><i
                            class="fas fa-ban"></i>Activate</a>
                @endif
                <a href="#" class="btn btn-danger btn-sm"><i
                        class="fas fa-ban"></i> Delete</a>

                <script>
                    $(document).ready(function() {
                        $('.delete-btn').on('click', function(e) {
                            e.preventDefault();

                            // Show a custom confirmation dialog
                            var confirmation = window.confirm('Are you sure you want to deactivate this product?');

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