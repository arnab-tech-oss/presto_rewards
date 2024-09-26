
<div class= "card card_content mb-0">
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="type">First Name</label>
            <input type="text" class="form-control" value="{{ strtoupper($customer->first_name) }}" readonly>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="type">Last Name</label>
            <input type="text" class="form-control" value="{{ strtoupper($customer->last_name) }}" readonly>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="role_id">Phone Number</label>
            <input type="text" class="form-control" placeholder="Enter your Btrand name"
                value=" {{ $customer->phone_number }} " readonly>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="form-group">
            <label>Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender"
                    id="male" value="male"
                    {{ $customer->gender == 'male' ? 'checked' : '' }} disabled>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender"
                    id="female" value="female"
                    {{ $customer->gender == 'female' ? 'checked' : '' }} disabled>
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>DOB</label>
            <input type="text" class="form-control" name="dob"
                value="{{ $customer->dob }}" readonly>

        </div>
    </div>

      {{-- <div class="col-sm-4">
        <div class="form-group">
            <label>District</label>
            <input required="" type="text" class="form-control"
                value="{{ $customer->address->address_1 ?? ''}}" name="district" readonly>
            @error('district')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
     </div> --}}

    <div class="col-sm-4">
        <div class="form-group">
            <label>State</label>
            <input required="" type="text" class="form-control"
                value= "{{ $customer->address->customerstate->state }}" name="state" readonly>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Pin Code</label>
            <input required="" type="text" class="form-control"
                value="{{ $customer->address->postal_code }}" name="postal_code"
                readonly>
            @error('postal_code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>District</label>
            <input required="" type="text" class="form-control"
                value="{{ $customer->address->customerstate->district ?? ''}}" name="district" readonly>
            @error('district')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Address 1</label>
            <input required="" type="text" class="form-control"
                value="{{ $customer->address->address_1 }}" name="address_1" readonly>
            @error('address_1')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label>Address 2</label>
            <input type="text" class="form-control"
                value="{{ $customer->address->address_2 }}" name="address_2" readonly>
            @error('address_2')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    