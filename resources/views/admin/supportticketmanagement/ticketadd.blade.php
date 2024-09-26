@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Ticket')
@section('content')

    <div class="main-content">
        <div class="page-content">
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
            </script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Create Ticket by Admin</h4>
                                </div>
                                <a href="{{ route('admin.tic.list') }}">
                                    <button type="submit" class="btn btn-primary add-list btn-md btn-rounded"><i
                                            class="uil-arrow-left"></i>Back to Ticket List</button>
                                </a>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.tic.cre') }}" name="form_data" onsubmit="return form_validation()" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Customer Name</label>
                                                <select id="customer_id" type="text" class="form-control selectpicker"
                                                    data-live-search="true" name="customer_id" required>
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->first_name . ' ' . $customer->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('customer_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="role_id" class="required">Subject</label>
                                                <input type="text" name="subject" class="form-control"
                                                    placeholder="Enter Customer Last Name" required>
                                                @error('subject')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Type</label>
                                                <select type="text" class="form-control product_input"
                                                    onchange="showproduct(this.value)" data-live-search="true" name="type"
                                                    required>
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($enquiries as $enquery)
                                                        <option value="{{ $enquery->enquiry_type }}">
                                                            {{ $enquery->enquiry_type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        {{-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Type</label>
                                                <input type="text" class="form-control" placeholder="Enter Type"
                                                    name="type" required>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Ticket No</label>
                                                <input type="text" class="form-control" name="ticket_no" readonly
                                                    value="{{ $tickitno }}">

                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Mode</label>
                                                <select id="mode"  type="text" class="form-control"
                                                    name="mode" required>
                                                    <option selected disabled>select one</option>
                                                    <option value="call">Call</option>
                                                    <option value="email">Email</option>
                                                </select>
                                            </div>
                                            @error('mode')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="">Status</label>
                                                <select id="type" required type="text" class="form-control"
                                                    name="status">
                                                    <option>select one</option>
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="col-sm-4">
                                            <div class="form-group product_id_input d-none">
                                                <label class="required">Product List</label>
                                                <select id="product" type="text" class="form-control" required
                                                    data-live-search="true" name="product_list">
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('product_list')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="role_id" class="required">Message</label>
                                                <textarea name="message" class="form-control" placeholder="Enter Message" required></textarea>
                                                @error('message')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i
                                                    class="uil uil-check me-2"></i>Add Ticket</button>
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

{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#state').change(function() {
            var selectedState = $(this).val();

            // Make an AJAX request to get the districts for the selected state
            $.get('{{ route('get.districts', '') }}/' + selectedState, function(data) {
                // Clear the current options
                $('#district').empty();

                // Add the new options based on the received data
                $.each(data, function(index, district) {
                    $('#district').append('<option value="' + district + '">' + district + '</option>');
                });
            });
        });
    });
</script> --}}

<script>
    // $("#qry_typ").on("change", function() {
    //     alert('hii');
    //     // var value = $(this).val();
    //     // console.log(value);
    //     if ($(this).val()) {
    //         $(".product_id_input").show();
    //         // $("#product").prop("required", true);
    //     } else {
    //         $(".product_id_input").hide();
    //         // $("#product").prop("required", false);
    //     }
    // });

    function showproduct(value) {
        //alert(value);
        if (value === "Products Related") {
            $(".product_id_input").removeClass('d-none');
            // $("#product").addClass('selectpicker');
            $('#product').prop("required", true);
        }else{
            $(".product_id_input").addClass('d-none');
            $("#product").prop("required", false);
        }
    }

    function from_validation(){
        var return_val = true;
        var mode= document.forms['form_data']['mode'].value;
        if (mode.length == ""){
            console.log("hi");
            return_val = false;
        }
        return return_val;
    }


</script>
