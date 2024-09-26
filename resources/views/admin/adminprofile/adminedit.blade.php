<div class= "card card_content mb-0">
<form id="form_data" action="{{route('admin.update', [$admin->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

        <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="required">Name</label>
                <input type="text" class="form-control" name="admin_name" value="{{($admin->full_name)}}">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="required">Email</label>
                <input type="text" class="form-control" name="admin_name" value="{{($admin->email)}}" readonly>
            </div>
        </div>

        {{-- <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="">Change Password</label>
                <input type="text" class="form-control" name="password" placeholder="Give Strong Password">
            </div>
        </div> --}}

        {{-- <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="">Confirm Password</label>
                <input type="text" class="form-control" name="c_password">
            </div>
        </div> --}}

        <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="required">Phone Number</label>
                <input type="text" class="form-control" name="phone" value="{{($admin->phone)}}" readonly>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="role_id" class="required">Address </label>
                <input type="text" class="form-control" name="address_1" placeholder="Enter Your Address" value="{{ $adminusers->address_1 ?? '' }}">
                @error('address_1')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <label>State</label>
                <input type="text" class="form-control" placeholder="Enter State" value="{{ $adminusers->state ?? '' }}" name="state" >
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <label>District</label>
                <input type="text" class="form-control" placeholder="Enter District" value="{{ $adminusers->district ?? '' }}" name="district" >
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Postal Code</label>
                <input type="text" class="form-control" placeholder="Enter Postal Code"  value="{{ $adminusers->postal_code ?? '' }}" name="pin" >
            </div>
        </div>



        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i class="uil uil-check me-2"></i>Update Profile</button>
            {{-- <script>
                $(document).ready(function() {
                    $('.update-btn').submit(function(e) {
                        e.preventDefault();

                        // Show a custom confirmation dialog
                        var confirmation = window.confirm('Are you sure you want to update this company?');

                        // If user confirms, submit the form
                        if (confirmation) {
                            this.submit();
                        }
                    });
                });
            </script> --}}
        </div>

    </div>
</form>
</div>
