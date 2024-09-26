@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'View Customer')
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
                                <h4 class="card-title text-capitalize">View Company by Admin</h4>
                            </div>


                            <a class="btn btn-primary add-list btn-sm text-white"
                                href="{{route('admin.customerlist')}}"><i class="las la-plus mr-3"></i>Back to Customer List</a>
                        </div>

                        <div class="card-body">
                            <form id="form_data" action="{{Route('admin.customer.update',[$customer->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="type" class="required">First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="{{$customer->first_name}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="required">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="{{$customer->last_name}}">
                                        </div>
                                    </div>

                                

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Phone Number</label>
                                            <input required="" type="text" class="form-control" name="phone_number" value="{{$customer->phone_number }}">
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Gender</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{$customer->gender === 'Male' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{$customer->gender === 'Female' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="Other" value="Other" {{$customer->gender === 'Female' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="Other">Others</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">DOB</label>
                                            <input type="text" class="form-control" name="dob" value="{{$customer->dob }}">
                                            
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">State</label>
                                            <input required="" type="text" class="form-control" value= "{{$customer->address->state }}" name="state">
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">Address 1</label>
                                            <input required="" type="text" class="form-control" value="{{$customer->address->address_1 }}" name="address_1">
                                                @error('address_1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <input type="text" class="form-control" value="{{$customer->address->address_2 }}" name="address_2">
                                                @error('address_2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Pin Code</label>
                                                <input required="" type="text" class="form-control" value="{{$customer->address->postal_code }}" name="postal_code">
                                                    @error('postal_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">District</label>
                                                    <input required="" type="text" class="form-control" value="{{$customer->address->district }}" name="district">
                                                        @error('district')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>


                                    <!-- {{-- <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="required">Logo</label>
                                            <input type="file" name="image" id="inputImage" class="form-control">
                                            @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div> --}}-->

                                    <div class="col-sm-12 text-center">
                                        <button type="submit"
                                            class="btn btn-primary mt-2">update Customer</button>
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