@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Rejected')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Rejected List</h4>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>S.No</th>
                                            <th>Customer Name</th>
                                            <th>Request Date</th>
                                            <th>Company</th>
                                            <th>amount</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <!-- Add action buttons here -->
                                                <a href="" class="btn btn-primary btn-sm"><i
                                                        class="fas fa-edit"></i> Approve</a>
                                                        
                                                        {{-- <a href=" class="btn btn-danger btn-sm delete-btn" id="deleteRoleBtn"><i
                                                            class="fas fa-ban"></i> Reject</a>   --}}
                                                       

                                                            {{-- <script>
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
                                                            </script> --}}
                                            </td>
                                        </tr>
                                      
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

@endsection