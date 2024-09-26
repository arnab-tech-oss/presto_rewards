@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'App Setting')
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

                    <div class="col-xl-12">
                          <!-- end card header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link mb-2" href="{{route('admin.app.set')}}">General</a>
                                            <a class="nav-link active mb-2" href="{{route('admin.app.company')}}">Company Info</a>
                                            <a class="nav-link  mb-2" href="{{route('admin.app.finance')}}">Finance</a>
                                            <a class="nav-link mb-2" href="{{route('admin.app.appkey')}}">App Keys</a>
<!--                                             <a class="nav-link mb-2" href="{{route('admin.setting.index')}}">Software</a> -->
                                            <a class="nav-link mb-2" href="{{route('admin.app.miscellaneous')}}">Miscellaneous</a>
                                            <a class="nav-link mb-2" href="{{route('admin.app.media')}}">Media</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                                        <div class="card tab-pane active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">

                                            <div class="card-header d-flex justify-content-between">
                                                <div class="header-title">
                                                    <h4 class="card-title text-capitalize">Company Settings</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{ route('admin.store.company') }}" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">Company Info :</h3>

                                                        <div class="form-group">
                                                            <label for="c_name">Company Name :</label>
                                                            <input type="hidden" value="{{ $c_info->id ?? '' }}"
                                                                name="id" id="id">
                                                            <input type="text" class="form-control"
                                                                value="{{ $c_info->company_name ?? '' }}" name="c_name"
                                                                id="c_name">
                                                        </div>
                                                        <div class="row">
                                                           <div class="form-group col-lg-6">
                                                              <label for="c_address">Address :</label>
                                                              <input type="text" class="form-control"
                                                              value="{{ $c_info->address ?? '' }}" name="c_address"
                                                              id="c_address">
                                                           </div>
                                                           <div class="form-group col-lg-6">
                                                              <label for="city">City :</label>
                                                              <input type="text" class="form-control"
                                                                value="{{ !empty($c_info->city) ? $c_info->city : '' }}"
                                                                name="city" id="city">
                                                           </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                               <label for="state">State :</label>
                                                               <input type="text" class="form-control"
                                                               value="{{ $c_info->state ?? '' }}" name="state"
                                                               id="state">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                               <label for="country_name">Country Name and Code :</label>
                                                               <input type="text" class="form-control"
                                                                 value="{{ !empty($c_info->country_name) ? $c_info->country_name : '' }}"
                                                                 name="country_name" id="country_name">
                                                            </div>
                                                         </div>

                                                         <div class="row">
                                                            <div class="form-group col-lg-6">
                                                               <label for="phone">Phone :</label>
                                                               <input type="text" class="form-control"
                                                               value="{{ $c_info->phone ?? '' }}" name="phone"
                                                               id="phone">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="phone">What's App Number :</label>
                                                                <input type="text" class="form-control"
                                                                value="{{ $c_info->whats_app_no ?? '' }}" name="wp_no"
                                                                id="phone">
                                                             </div>
                                                            <div class="form-group col-lg-6">
                                                               <label for="email">Email :</label>
                                                               <input type="text" class="form-control"
                                                                 value="{{ !empty($c_info->email) ? $c_info->email : '' }}"
                                                                 name="email" id="email">
                                                            </div>
                                                         </div>


                                                            <div class="form-group" id="myForm">
                                                               <label for="gst" class="required">GST/TAX/VAT Number :</label>
                                                               <input type="number"  class="form-control limitedTxt"
                                                               value="{{ !empty($c_info->gst_number) ? $c_info->gst_number : ''}}" name="gst"
                                                               id="gst" required>
                                                               <div>Character Limit <span class="charLimit"></span> <span class="charLeft"></span></div>
                                                            </div>
                                                                 @error('gst')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                 @enderror

                                                    <div class="form-group">
                                                        <label for="header">Company Header Format (PDF and HTML) :</label>
                                                        <input type="text" class="form-control"
                                                        value="{{ !empty($c_info->company_header) ? $c_info->company_header : ''}}" name="header" id="header">
                                                     </div>

                                                    <div class="form-group">
                                                        <label for="c_logo"class="required">Company Logo (If Any) :</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $c_info->company_logo ?? '' }}" name="c_logo"
                                                            id="c_logo" required>
                                                        @if (!empty($c_info->company_logo))
                                                            <img src="{{ url($c_info->company_logo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>

                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i> Update </button>
                                                    </div>
                                                       </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->


            </div>
        </div>
    {{-- </div>
    </div> --}}
    {{-- </div>
    </div> --}}

{{-- @endsection --}}

{{-- @section('scripts') --}}
    <script>
     $(document).ready(function() {
  charLimit(15);
});

function charLimit(limit){

  $('.charLimit').text('(' + limit + '):');
  $('.charLeft').text(limit);

  //still working on getting mouse cut and paste working
  $('.limitedTxt').bind({
    copy : function(){
      console.log("copy");
    },
    paste : function(){
      console.log("paste");
      var charLen = this.value.length;
      var textVal = limit - charLen;
      console.log(charLen);
      console.log(textVal);
      if (charLen >= limit) {
        this.value = this.value.substring(0, limit);
      }
      if (textVal <= limit && textVal > 1){
      $('.charLeft').removeClass('charError').text(textLen);
      }
    },
    cut : function(){
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
    if (textVal <= limit && textVal > 1){
      $('.charLeft').removeClass('charError').text(textLen);
    }else if(textVal <= 0){
      $('.charLeft').text('limit reached').addClass('charError');
    }
  });
}

    </script>
@endsection
