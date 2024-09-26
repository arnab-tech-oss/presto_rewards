@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Coupon Request')
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
                                <h4 class="card-title text-capitalize">Setup</h4>
                            </div>

                        </div>

            <form action="{{ route('admin.setting.store') }}" name="setting" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <h3 class="mb-2 text-muted">App Store  :</h3>
                <div class="px-3">
                    <div class="form-group">
                        <label for="software_title">Link :</label>
                        <input type="hidden" value="{{ $setting->id ?? '' }}" name="id" id="id">
                        <input type="text" class="form-control" value="{{ $setting->software_title ?? '' }}"
                               name="software_title"
                                id="software_title">
                     </div>
                    <!-- <div class="form-group">
                        <label for="software_description">Description :</label>
                        <textarea class="form-control" name="software_description"
                                  id="software_description"
                                  style="min-height: 150px;">{{ $setting->software_description ?? '' }}</textarea>
                    </div>  -->
                    <!-- <div class="form-group">
                        <label for="software_version">Version :</label>
                        <input type="text" class="form-control" value="{{ !empty($setting->software_version) ? $setting->software_version : '' }}"
                               name="software_version" id="software_version" >
                    </div>   -->

                 </div>
                <hr/>
                <h3 class="mb-2 text-muted">Play Store :</h3>
                <div class="px-3">
                    <div class="form-group">
                        <label for="company_name">Link :</label>
                        <input type="text" class="form-control" value="{{ $setting->company_name ?? '' }}"
                               name="company_name"
                               id="company_name">
                    </div>
                    <!-- <div class="form-group">
                        <label for="company_logo">Logo :</label>
                        <input type="file" class="form-control" value="{{ $setting->company_logo ?? '' }}"
                               name="company_logo"
                               id="company_logo">
                        @if(!empty($setting->company_logo))
                            <img src="{{  url($setting->company_logo) }}" class="img-thumbnail my-2"
                                 height="250"
                                 width="250">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="company_intro">Introduction :</label>
                        <textarea class="form-control" style="min-height: 150px;" name="company_intro" id="company_intro">{{ $setting->company_intro ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="company_email">Email :</label>
                        <input type="email" class="form-control" value="{{ $setting->company_email ?? '' }}"
                               name="company_email"
                               id="company_email">
                    </div>
                    <div class="form-group">
                        <label for="company_alternative_email">Alternative Email :</label>
                        <input type="email" class="form-control" value="{{ $setting->company_alternative_email ?? '' }}"
                               name="company_alternative_email" id="company_alternative_email">
                    </div>
                    <div class="form-group">
                        <label for="company_contact_no">Contact No :</label>
                        <input type="number" class="form-control" value="{{ $setting->company_contact_no ?? '' }}"
                               name="company_contact_no" id="company_contact_no">
                    </div>
                    <div class="form-group">
                        <label for="company_alternative_contact_no">Alternative Contact No :</label>
                        <input type="number" class="form-control"
                               value="{{ $setting->company_alternative_contact_no ?? '' }}"
                               name="company_alternative_contact_no" id="company_alternative_contact_no">
                    </div>

                    <div class="form-group">
                        <label for="company_gst_no">GST No :</label>
                        <input type="text" class="form-control" value="{{ $setting->company_gst_no ?? '' }}"
                               name="company_gst_no" id="company_gst_no">
                    </div>
                </div>
                <h3 class="mb-2 text-muted">Billing Info :</h3>
                <div class="px-3">
                    <div class="form-group">
                        <label for="billing_header">Header :</label>
                        <textarea class="form-control" name="billing_header"
                                  id="billing_header"
                                  style="min-height: 150px;">{{ $setting->billing_header ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="billing_footer">Footer Left:</label>
                        <textarea class="form-control" name="billing_footer"
                                  id="billing_footer"
                                  style="min-height: 150px;">{{ $setting->billing_footer ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="billing_footer">Footer Right:</label>
                        <textarea class="form-control" name="billing_footer1"
                                  id="billing_footer1"
                                  style="min-height: 150px;">{{ $setting->billing_footer1 ?? '' }}</textarea>
                    </div>
                </div>
                <h3 class="mb-2 text-muted">Notification Emails :</h3>
                <div class="px-3">
                    <div class="form-group">
                        <label for="email_cc">CC :</label>
                        <input type="text" class="form-control" value="{{ $setting->email_cc ?? '' }}" name="email_cc"
                               id="email_cc">
                    </div>
                    <div class="form-group">
                        <label for="email_bcc">BCC :</label>
                        <input type="text" class="form-control" value="{{ $setting->email_bcc ?? '' }}"
                               name="email_bcc"
                               id="email_bcc">
                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary add-list btn-sm text-white">Save</button>
                </div>
            </div>

        </form>
    </div>
</div>
</div>-->
</div>
</div>
</div>
</div>  

@endsection

@section('scripts')
    <script>
        /* $('#generate_api_key').on('click', function () {
            const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $('#api_key').val(id);
        }); */
    </script>
@endsection

