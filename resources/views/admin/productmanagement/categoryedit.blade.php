@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'pages')
@section('content')




<div class="main-content">
    <div class="page-content">
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Category Edit By Admin</h4>
                            </div>


                            <!-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.setting.showdata')}}"><i -->
                                    <!-- class="las la-plus mr-3"></i>Back to setting Pages</a> -->
                        </div>


                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                    <form method="POST"  action="{{ route('admin.category.update',1) }} " enctype="multipart/form-data">
@csrf
                                        <tr class="ligth">

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="optional">Category Name</label>
                                            <input type="text" class="form-control" placeholder="" name="name" value="{{$category_edit->name}}">

                                            @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                               
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <input type="text" class="form-control" placeholder="" name="description" value="{{$category_edit->description}}">

                                            @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>


                                                <div class="col-sm-4">
                                              <div class="form-group">
                                            <label class="optional">Image</label>
                                            <img src="{{asset($category_edit->image)}}" alt="Company Logo" class="img-fluid">
                                            <input type="file" name="image" id="inputImage" class="form-control">

                                            @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                            <tr>
                                              
                                    
                                                   
                                              
                                                 <td class="text-center">
                                                    <!-- Add action buttons here -->
                                                   

                                                    <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update
                                                Category</button>
                                        </div> 
                                                 </td> 
                                            </tr>
                                  
                                    </tbody>
                                   
                                    </form>
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

@endsection