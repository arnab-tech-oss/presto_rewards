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
                                    <h4 class="card-title">Notification List</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="">
                                    <div class="">
                                    <table style="display:block" class="table-responsive datatable table align-middle table-nowrap table-check" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>sys_id</th>
                                                <th>Customer Name</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                {{-- <th>Status</th> --}}
                                            </tr>
                                        </thead>
                                        
                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.notification.list') }}",

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'notifi.first_name',
                                                            name: 'notifi.first_name',
                                                        },
                                                        {
                                                            data: 'message',
                                                            name: 'message',
                                                        },                                                
                                                        {
                                                            data: 'date_time',
                                                            name: 'date_time',
                                                        },
                                                        // {
                                                        //     data: 'is_read',
                                                        //     name: 'is_read'
                                                        // },
                                                
                                                    ]
                                                      
                                                });
                                            });
                                        </script>
                                    </table>
                                </div>
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