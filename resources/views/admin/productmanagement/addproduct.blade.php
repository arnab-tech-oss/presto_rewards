@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Product')
@section('content')
<div class="main-content">
    <div class="page-content">

        <script>
            @if (Session::has('error'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar" : true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('error') }}");
                @endif
                </script>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title text-capitalize">Create Product by Admin</h4>
                            </div>
                             <a href="{{route('admin.product')}}">
                                <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left"></i>Back to Product List</button>
                            </a>
                            </div>

                        <div class="card-body">
                            <form id="form_data" action="{{route('admin.product.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="type" class="required">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" required>
                                            @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">MRP</label>
                                            <input type="number" class="form-control"
                                                placeholder="Enter Price Range" name="price_range">
                                                @error('price_range')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="brand_id" class="required">Brand</label>
                                            <select id="brand_id" required type="text" class="form-control selectpicker"  data-live-search="true"
                                                name="brand_id">
                                                <option selected disabled>Select Brand</option>
                                                @foreach ($brand as $company)
                                                <option value="{{$company->id}}">{{$company->brand_title}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Category</label>
                                            <select  type="text" class="form-control selectpicker" data-live-search="true"
                                                name="category">
                                                <option selected disabled>Select Category</option>
                                                @foreach ($category as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Catalog</label>
                                            <select  type="text" class="form-control selectpicker" data-live-search="true"
                                                name="catalog_id">
                                                <option selected disabled>Select Catalog</option>
                                                @foreach ($catalog as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Product Code</label>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Product Code" name="product_code">
                                                @error('')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <textarea type="text" class="form-control" placeholder="Enter Description Here" name="description"></textarea>
                                            @error('')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Product Image</label>
                                            <input type="file" name="image" id="inputImage" class="form-control">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add Product</button>
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
