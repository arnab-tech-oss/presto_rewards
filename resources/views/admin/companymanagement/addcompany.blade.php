@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Company')
@section('content')
<div class="main-content">
    <div class="page-content" style="padding:35px 0 80px 0">
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

                    <div id="" class="">
                        <div class="card">
                            {{-- <a href="#addproduct-billinginfo-collapse" class="text-reset text-reset d-flex flex-grow-1" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse"> --}}
                                <div class="p-4">

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Create Brand by Admin</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                        <a href="{{route('admin.company')}}">
                                            <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left me-2"></i>Back to Brand List</button>
                                        </a>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            {{-- </a> --}}

                            <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion" style="">
                                <div class="p-4 border-top">

                                    <form id="form_data" action="{{route('admin.company.post')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="type" class="required">Brand Name</label>
                                                    <input type="text" name="company_name" class="form-control" placeholder="Enter Brand  Name" required>
                                                    @error('company_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="role_id" class="required">Brand Title</label>
                                                    <input type="text" name="brand_title" class="form-control" placeholder="Enter Brand Title" required>
                                                    @error('brand_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">Brand Logo</label>
                                                    <input type="file" name="image" id="inputImage" class="form-control">
                                                    @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="">Brand Address</label>
                                                    <textarea type="text" class="form-control"
                                                        placeholder="Enter Brand  Address" name="company_address"></textarea>
                                                        @error('company_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>


                                            {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Add Company</button> --}}


                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                            <div class="p-4">
                                <form id="form_data" action="{{route('admin.company.post')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="d-flex align-items-center">

                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Bank Info</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                    </div>

                                </div>

                            </div>

                        <div >
                            <div class="p-4 border-top">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="">Bank Name</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Bank Name" name="bank_name">
                                                    @error('bank_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="">Bank Account Number</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter your Bank Account Number" name="bank_acc_number">
                                                    @error('bank_acc_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="">Bank Ifsc</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Bank IFSC Code" name="bank_ifsc">
                                                    @error('bank_ifsc')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>

                     </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-sm-12 text-center">
                <button type="submit"
                class="btn btn-success btn-rounded" ><i class="uil uil-check me-2"></i>Add Brand</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection


@if (session()->has('failure'))
  <div class="alert alert-danger">
   <script>
    alert('failure')
   </script>
  </div>
@endif
