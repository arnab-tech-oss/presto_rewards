@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'pages')
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
  
    @if (Session::has('message'))
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('message') }}");
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
                                <h4 class="card-title">Page List</h4>
                            </div>
                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{route('admin.setting.showpages')}}"><i class="mdi mdi-plus me-1"></i> New Page</a>        
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>sys_id</th>
                                            <th>Tittle</th>
                                            <th> Description</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <script type="text/javascript">
                                            $(function() {
                                                var table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.setting.showdata') }}",

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'tittle',
                                                            name: 'tittle',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description'
                                                        },
                                                        // {
                                                        //     data: 'status',
                                                        //     name: 'status'
                                                        // },
                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false,
                                                        },
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

@endsection