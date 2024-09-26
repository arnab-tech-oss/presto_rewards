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
                @if (Session::has('failure'))
                        toastr.options = {
                            "closeButton": true,
                            "progressBar" : true,
                            "positionClass": "toast-top-center",
                            "showDuration": "300",
                        }
                        toastr.error("{{ session('failure') }}");
                    @endif
                </script>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Add Category</h4>
                                </div>        
                                    <a href="{{route('category.list')}}">
                                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left"></i>Back to Category List</button>
                                    </a>
                            </div>

                            <div class="card-body">
                                <form id="form_data" action="{{route('category.add.post')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Category Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter category Name" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="type" class="">Category Image</label>
                                                <input type="file" name="image" class="form-control required"
                                                    placeholder=" Description" required>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

{{--                                         
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="brand_id" class="required">Product Name</label>
                                                <select id="brand_id" required type="text"
                                                    class="form-control selectpicker" data-live-search="true"
                                                    placeholder="Enter product  " name="product">
                                                    <option selected disabled> - Select Product - </option>
                                                    @foreach ($data as $item)
                                                        <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
 --}}


                                        {{-- <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="">Product</label>
                                                <select class="form-control" name="products[]" multiple>
                                                    <option>Select One</option>
                                                    @foreach ($data as $item) <option value="{{$item->id}}">{{$item->product_name}}</option>            
                                                    @endforeach
                                                </select>
                                                @error('products')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="">Product Name</label><br>
                                                <select class="selectpicker"  multiple data-live-search="true" name="products[]" multiple="multiple">
                                                    <option value="" selected disabled >Select multiple products</option>
                                                    @foreach ($data as $item)
                                                        <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="type" class="">Category Description</label>
                                                <textarea name="description" class="form-control" placeholder="Category Description" id="description"></textarea>
                                                @error('')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                       


                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add
                                                Category</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
