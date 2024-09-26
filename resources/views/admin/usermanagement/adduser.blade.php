@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add User')
@section('content')
<div class="main-content">
    <div class="page-content">
        <script>
            @if (Session::has('failure'))
                toastr.options = {
                    "closeButton": true,
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
                                <h4 class="card-title text-capitalize">Create User by Admin</h4>
                            </div>
                                <a href="{{route('admin.usermanagement')}}">
                                    <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left"></i>Back to Users List</button>
                                </a>
                        </div>

                        <div class="card-body">
                            <form id="form_data" action="{{route('user.add.post')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="type" class="required">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="Enter your full name">
                                            @error('full_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="required">email Id</label>
                                            <input type="text" class="form-control" name="email_id"  value="{{ old('email_id') }}" placeholder="Enter your mail-id">
                                            @error('email_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Phone Number</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter your phone number"  value="{{ old('phone_number') }}" name="phone_number">
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Password</label>
                                            <input required="" type="password" class="form-control"
                                                placeholder="Enter your password"  value="{{ old('password') }}" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Role</label>
                                            <select id="type" required="" type="text" class="form-control"
                                                name="role">
                                                <option value="">Select One</option>
                                                @foreach ($roles as $entry)
                                                <option value="{{$entry->id}}">{{$entry->role_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Company</label>
                                            <select id="type" required="" type="text" class="form-control"
                                                name="company_id">
                                                <option value="">select one</option>
                                                @foreach ($companies as $company)
                                                <option value="{{$company->id}}">{{ $company->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label >Address </label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter your address"  value="{{ old('address_1') }}" name="address_1">
                                            @error('address_1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Address 2</label>
                                            <input required="required" type="text" class="form-control"
                                                placeholder="Enter address 2" name="address_2">
                                            @error('address_2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">State</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter your state" name="state">
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">District</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter your district" name="district">
                                            @error('district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Pincode</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter pincode" name="postal_code">
                                            @error('postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}


                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add user</button>
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
