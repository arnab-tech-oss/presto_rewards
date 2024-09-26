@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add pages')
@section('content')




    <div class="main-content">
        <div class="page-content">
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Add Category</h4>
                                </div>


                                <!-- <a class="btn btn-primary add-list btn-sm text-white" -->
                                    <!-- href="{{route('admin.setting.showdata')}}"><i class="las la-plus mr-3"></i>Back to Setting Page</a> -->
                            </div>

                            <div class="card-body">
                                <form id="form_data" action="{{route('admin.category.add')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="type your name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Description</label>
                                                <input type  name="description" class="form-control" placeholder=" Description" id="description">
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="required"> Image</label>
                                                <input type="file" name="image" id="inputImage" class="form-control" required>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary add-list btn-sm text-white">Add
                                                Category</button>
                                        </div>
                                    </div>
                                   



                                </form>
                            </div>
                        </div>
                    </div>

                    <script src=""></script>

                   

                </div>
            </div>
        </div>
    </div>
    

@endsection