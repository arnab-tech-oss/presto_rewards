@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Customer')
@section('content')

    <div class="main-content" style="padding:0px 0 70px 0">
        <div class="page-content">

            <div class= "card ">


                <a href="#addproduct-billinginfo-collapse" class="text-reset" data-bs-toggle="collapse"
                aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title text-capitalize">Edit Customer by Admin</h4>
                    </div>
                    <a href="{{ route('admin.customerlist') }}">
                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded"><i
                                class="uil-arrow-left"></i>Back to Customer List</button>
                    </a>
                </div>

                <form action="{{ route('admin.customer.update', [$cust->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">First Name</label>
                                <input type="text" name="first_name" required class="form-control"
                                    value="{{ strtoupper($cust->first_name) }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="{{ strtoupper($cust->last_name) }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="role_id" class="required">Phone Number</label>
                                <input type="text" class="form-control" required placeholder="Enter your Btrand name"
                                    value=" {{ $cust->phone_number }} " readonly>
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" required type="radio" name="gender" id="male"
                                        value="Male" {{ $cust->gender == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="Female" {{ $cust->gender == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other"
                                        value="Other" {{ $cust->gender == 'Other' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="other">Others</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">DOB</label>
                                <?php
                                // Assuming $cust->dob contains the date in dd-mm-YY format
                                // Convert the date format to YY-mm-dd
                                $dobFormatted = date('Y-m-d', strtotime($cust->dob));
                                ?>
                                <input type="date" required class="form-control" name="dob"
                                    value="{{ $dobFormatted }}">

                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password" class="">Change Password</label>
                                <input type="text" class="form-control" placeholder="Give Strong Password"
                                    name="password">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="passcode" class="required">Login Pin</label>
                                <input type="text" class="form-control" required placeholder="Enter your Login pin"
                                    value=" {{ $cust->passcode }}" name="passcode">
                            </div>
                        </div>


                        {{-- <div class="col-sm-4">
            <div class="form-group">
                <label>District</label>
                <input required="" type="text" class="form-control"
                    value="{{ $cust->address->address_1 ?? ''}}" name="district" readonly>
                @error('district')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
         </div> --}}
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">Address 1</label>
                                <input required type="text" class="form-control" value="{{ $cust->address->address_1 }}"
                                    name="address_1">
                                @error('address_1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" class="form-control" value="{{ $cust->address->address_2 }}"
                                    name="address_2">
                                @error('address_2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">State</label>
                                <select type="text" class="form-control selectpicker" data-live-search="true"
                                    name="state" id="state" onchange="get_district(this.value)" required>
                                    <option>Select State</option>
                                    @foreach ($state as $s)
                                        <option value="{{ $s->state }}"
                                            {{ $cust->address->customerstate->state == $s->state ? 'selected' : '' }}>
                                            {{ $s->state }}</option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">District</label>
                                <select type="text" class="form-control selectpicker" data-live-search="true"
                                    name="state_id" id="district" required>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ $cust->address->customerstate->id == $district->id ? 'selected' : '' }}>
                                            {{ $district->district }}</option>
                                    @endforeach
                                </select>
                                @error('district')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">Pin Code</label>
                                <input required type="text" class="form-control"
                                    value="{{ $cust->address->postal_code }}" name="postal_code">
                                @error('postal_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">Verify</label>
                                <select class="form-control" name="verify">
                                    <option value="true" {{ $cust->verify == 'true' ? 'selected' : '' }}>True</option>
                                    <option value="false" {{ $cust->verify == 'false' ? 'selected' : '' }}>False</option>
                                </select>
                              
                            </div>
                        </div>



                        {{-- <div class="col-sm-4">
            <div class="form-group">
                <label class="required">District</label>
                <input required type="text" class="form-control"
                    value="{{ $cust->address->customerstate->district ?? ''}}" name="district">
                @error('district')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div> --}}



                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update
                                Customer</button>
                        </div>

                    </div>
                    </div>
                </form>


            </div>
        </div>
    </div>


    <script>
        function get_district(value) {
            //alert(value);
            var state = value;
            if (state) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('cus.dis', ':state') }}'.replace(':state', state),
                    success: function(data) {
                        $('#district').empty();
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.district +
                                '</option>');
                        });
                        $('.selectpicker').selectpicker('refresh');
                    }
                })
            }
        }
    </script>
@endsection
