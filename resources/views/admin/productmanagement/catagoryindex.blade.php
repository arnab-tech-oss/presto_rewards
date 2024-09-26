@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'pages')
@section('content')

           <script>
                @if (Session::has('success'))
                        toastr.options = {
                            "closeButton": true,
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
                                <h4 class="card-title">Catagory List</h4>
                            </div>

 
                            <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.category.show')}}"><i
                                    class="las la-plus mr-3"></i>Add Category</a>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <tr class="ligth">
                                            <th>S.No</th>
                                            <th>Catagory Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                             </td> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($categorylist as $list)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->description}}</td>
                                                <td><img src="{{asset($list->image)}}" alt="Image" class="img-fluid rounded" style="width:50px;"></td>
                                                   
                                                 <td class="text-center">
                                                    <!-- Add action buttons here -->
                                                    <a href="{{route('admin.category.edit',[$list->id])}}" class="btn btn-primary btn-sm"><i
                                                            class="fas fa-edit"></i> Edit</a>
                                                    <!-- <a href=""
                                                        class="btn btn-danger btn-sm delete-btn" id="deleteRoleBtn"><i
                                                            class="fas fa-ban"></i> Delete</a>  -->

                                                 
                                                 </td> 
                                            </tr>
                                           @endforeach
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