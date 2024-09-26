<div class= "card card_content mb-0">
<form id="form_data" action="{{route('company.udate', [$company->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="card">
   <div class="card-body">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type" class="required">Brand Name</label>
                <input type="text" class="form-control" name="brand_name" value="{{ strtoupper($company->company_name) }}">
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="role_id" class="required">Brand Title</label>
                <input type="text" class="form-control" name="brand_title" placeholder="Enter your Btrand name" value="{{ $company->brand_title }}">
                @error('brand_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="required"> Status</label>
                <select class="form-control" name="status">
                    {{-- <option value="selectValue" disabled selected hidden>
                        {{ $company->status }}</option> --}}
                        <option value="active" {{ $company->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $company->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Brand Address</label>
                <textarea type="text" class="form-control" name="company_address">{{ $company->company_address }}</textarea>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Brand Logo</label>
                <input type="file" name="image" id="inputImage" class="form-control">
                <br>
                <img src="{{ asset($company->logo) }}" alt="Company Logo" class="img-fluid mb-2"
                    style="width:200px;">
            </div>
        </div>
       </div>
      </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
        <div class="row">

          <div class="col-sm-4">
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" value="{{ $company->bank_name }}" name="bank_name" >
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    <label>Bank Account Number</label>
                    <input type="text" class="form-control" value="{{ $company->bank_acc_number }}" name="bank_acc_number" >
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label>Bank IFSC</label>
                    <input type="text" class="form-control" value="{{ $company->bank_ifsc }}" name="bank_ifsc">
                </div>
            </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>GSTIN Number</label>
                <input type="text" class="form-control" value="{{ $company->gstin }}" name="gstin" >
            </div>
        </div>



      </div>
    </div>
    </div> --}}
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i class="uil uil-check me-2"></i>Update Company</button>
            <script>
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
            </script>
        </div>
</form>
</div>
