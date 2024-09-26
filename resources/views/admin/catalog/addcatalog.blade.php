@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Select multiple products',
            allowClear: true, // Enables the clear button
            minimumResultsForSearch: Infinity, // Disables the search box
        });
    });
</script>
@endpush
@section('title', 'Add Product Catalog')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <script>
                @if (Session::has('error'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
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
                                    <h4 class="card-title text-capitalize">Create Catalogue by Admin</h4>
                                </div>
                                <a href="{{route('admin.catalog')}}">
                                    <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left"></i>Back to Catalog List</button>
                                </a>
                            </div>

                            <div class="card-body">
                                <form id="form_data" action="{{ route('admin.catalog.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Catalogue Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Catalogue Name" name="name" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Product Name</label>
                                                <select id="type"  multiple class="form-control" name="product[]">
                                                    <option><input type="checkbox">select one</option>
                                                    @foreach ($data as $entity)
                                                    <option value="{{$entity->id}}">{{$entity->product_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="product[]" class="required">Product Name</label><br>
                                                <select id="product[]" required type="text" class="selectpicker"   multiple data-live-search="true" name="product[]" multiple="multiple">
                                                    <option  selected disabled >Select multiple products</option>
                                                    @foreach ($data as $entity)
                                                        <option value="{{ $entity->id }}">{{ $entity->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                @error('product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="brand_id" class="required">Product Name</label>
                                                <select id="brand_id" required type="text"
                                                    class="form-control selectpicker" data-live-search="true"
                                                    placeholder="Enter product  " name="product">
                                                    <option selected disabled> - Select Product - </option>
                                                    @foreach ($data as $entity)
                                                        <option value="{{ $entity->id }}">{{ $entity->product_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        {{-- <script>
                                            $(document).ready(function() {
                                                $('.js-example-basic-multiple').select2({
                                                    placeholder: 'Select multiple',
                                                    ajax: {
                                                        url: '{{ route("api.getOptions") }}', // Update this route
                                                        dataType: 'json',
                                                        processResults: function(data) {
                                                            return {
                                                                results: data
                                                            };
                                                        }
                                                    }
                                                });
                                            });
                                        </script> --}}



                                        {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Company Name</label>
                                                <select id="type" required type="text" class="form-control"
                                                    name="type">
                                                    <option>select one</option>
                                                    @foreach ($datas as $data)
                                                    <option value="{{$data->id}}">{{$data->company_name}}</option>
                                                    @endforeach
                    
                                                </select>
                                                    
                                                    {{-- @foreach ($data as $entry)
                                                <option value="{{$entry->id}}">{{$entry->brand_title}}</option>
                                                @endforeach --}}
                                        {{-- </div>
                                        </div> --}}


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional">Catalogue Description</label>
                                                <textarea type="text" class="form-control" placeholder="Enter description" name="description"></textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="">catalogue Icon</label>
                                                <input type="file" name="image" id="inputImage" class="form-control" >
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add
                                                Catalogue</button>
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
