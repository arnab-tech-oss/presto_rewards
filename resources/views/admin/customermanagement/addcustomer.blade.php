@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Customer')
@section('content')

    <div class="main-content" style="padding:0px 0 70px 0">
        <div class="page-content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <a href="#addproduct-billinginfo-collapse" class="text-reset" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title text-capitalize">Create Customer by Admin</h4>
                                    </div>
                                    <a href="{{ route('admin.customerlist') }}">
                                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded"><i
                                                class="uil-arrow-left"></i>Back to Customer List</button>
                                    </a>
                                </div>
                                <form id="form_data" action="{{ route('customer.add.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="type" class="required">First Name</label>
                                                    <input type="text" name="first_name" class="form-control"
                                                        placeholder="Enter Customer First Name" required>
                                                    @error('first_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="role_id" class="required">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        placeholder="Enter Customer Last Name" required>
                                                    @error('brand_title')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="role_id" class="">Email</label>
                                                    <input type="email" name="email_id" class="form-control"
                                                        placeholder="Enter Customer Mail">
                                                    @error('email_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Role Name</label>
                                                <input type="text" name="role_name" class="form-control" value="customer" readonly>
                                            </div>
                                        </div> --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Phone Number</label>
                                                    <input type="tel" pattern="[6-9]{1}[0-9]{9}" min="10"
                                                        title="share Valid number. Eg:  7003816820" class="form-control"
                                                        placeholder="Enter Phone Number" name="phone_number" id="phone_number" onkeyup = "maxvalidation(this.value,'phone_number',10);" required>
                                                    @error('phone_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">Alternative Phone Number</label>
                                                    <input type="tel" pattern="[6-9]{1}[0-9]{9}" min="10"
                                                        title="share Valid number. Eg:  7003816820" class="form-control"
                                                        placeholder="Alternative Phone Number" name="alt_phone_number" id="alt_phone_number" onkeyup = "maxvalidation(this.value,'phone_number',10);" >
                                                    @error('alt_phone_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- <input type="tel" pattern="[6-9]{1}[0-9]{9}" min="10" title="share Valid number. Eg:  7003816820" class="form-input" placeholder="Contact Number*"  required=""> --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Gender</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="Male" value="Male" required>
                                                        <label class="form-check-label" for="male">Male</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="Female" value="Female" required>
                                                        <label class="form-check-label" for="female">Female</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                            id="Other" value="Other" required>
                                                        <label class="form-check-label" for="Other">Others</label>
                                                    </div>
                                                    <br>
                                                    <!-- You can add more radio options if needed -->

                                                    @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">DOB</label>
                                                    <input type="date" id="datepicker" class="form-control"
                                                        placeholder="Enter Date Of Birth" name="dob" required
                                                        {{-- max="<?php echo date('Y-m-d'); ?>"  --}} max="<?php echo date('Y-m-d', strtotime('-10 years')); ?>">
                                                    @error('dob')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Password</label>
                                                    <input type="text" class="form-control" name="password" readonly
                                                        value="{{ $pass }}">

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Login Pin</label>
                                                    <input type="text" class="form-control" name="pass_code" readonly
                                                        value="{{ $pin }}">

                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>


                        <div class= "card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Enter Customer Address</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class ="row">

                                    {{-- 
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label class="">State</label><br>
                                            <select class="selectpicker"  multiple data-live-search="true" name="state" id="state" multiple="multiple">
                                                <option value="" selected disabled >Select multiple products</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district }}">{{ $district }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">GSTIN</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="Enter GSTIN Number" name="gstin">
                                                @error('gstin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Address 1</label>
                                            <input type="text" class="form-control" placeholder="Enter Address Line 1"
                                                name="address_1" required>
                                            @error('address_1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Address 2</label>
                                            <input type="text" class="form-control" placeholder="Enter Address Line 2"
                                                name="address_2">
                                            @error('address_2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">State</label>
                                                <select type="text" class="form-control selectpicker"
                                                    data-live-search="true" name="state" id="state" required>
                                                    <option>Select State</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state }}">{{ $state }}</option>
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
                                                <select type="text" class="form-control selectpicker"
                                                    data-live-search="true" name="district" id="district" required>
                                                    <option>Select District</option>
                                                </select>
                                                @error('district')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">PinCode</label>
                                            <input type="number" class="form-control limitedTxt" placeholder="Enter Pin Number"
                                                name="postal_code" required>
                                            @error('postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="">Status</label>
                                                <select id="type" required type="text" class="form-control"
                                                    name="status">
                                                    <option>select one</option>
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        

                                </div>
                            </div>
                        </div>   

                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-success btn-rounded"><i
                                    class="uil uil-check me-2"></i>Add Customer</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (Session::has('failure'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "300",
            }
            toastr.error("{{ session('failure') }}");
        @endif

        $(document).ready(function() {
            $('#state').change(function(e) {
                e.preventDefault();
                var state = $(this).val();
                //console.log(state);
                $('#district').html('<option value="">Select District</option>');
                if (state) {
                    $.ajax({
                        type: "GET",
                        url: '{{ route("customer.district", ":state") }}'.replace(':state', state),
                        success: function (data) {
                            $.each(data, function (key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.district + '</option>');
                        });
                        $('.selectpicker').selectpicker('refresh')
                        }
                    });
                }
            });
        });

        $('#form_data').submit(function(e) {
            e.preventDefault();
            var state = $('#state').val();
            var district = $('#district').val();
            if (state && district) {
                // Include the district value in the form submission
                $(this).append('<input type="hidden" name="district" value="' + district + '">');
                $(this).append('<input type="hidden" name="state" value="' + state + '">');
                // Submit the form
                this.submit();
            } else {
                alert('Please select both state and district.');
            }
        });
        $(function() {
            // Set the default date to 10 years ago
            var defaultDate = new Date();
            defaultDate.setFullYear(defaultDate.getFullYear() - 10);

            // Initialize the datepicker
            $("#datepicker").datepicker({
                defaultDate: defaultDate,
                maxDate: new Date(), // Set the maximum date to the current date
                changeMonth: true,
                changeYear: true,
                yearRange: "-10:+0" // Allow selecting dates from 10 years ago to the current date
            });
        });
        // This function use for validation

        $(document).ready(function() {
            charLimit(6);
        });

        function charLimit(limit) {

            $('.charLimit').text('(' + limit + '):');
            $('.charLeft').text(limit);

            //still working on getting mouse cut and paste working
            $('.limitedTxt').bind({
                copy: function() {
                    console.log("copy");
                },
                paste: function() {
                    console.log("paste");
                    var charLen = this.value.length;
                    var textVal = limit - charLen;
                    console.log(charLen);
                    console.log(textVal);
                    if (charLen >= limit) {
                        this.value = this.value.substring(0, limit);
                    }
                    if (textVal <= limit && textVal > 1) {
                        $('.charLeft').removeClass('charError').text(textLen);
                    }
                },
                cut: function() {
                    console.log("cut");
                }
            });

            $('.limitedTxt').keyup(function() {
                var charLen = this.value.length;
                var textLen = $('.charLeft').text(limit - charLen);
                var textVal = limit - charLen;
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    $('.charLeft').removeClass('charError').text(textLen);
                } else if (textVal <= 0) {
                    $('.charLeft').text('limit reached').addClass('charError');
                }
            });
        }
        //  This function for Pnone no validation 
        function maxvalidation(value,id,max){
            var length = value.length;
            if(length > max){
                var new_val = value.substr(0,max);
                document.getElementById(id).value = new_val;
            }
        }

    </script>

@endsection
