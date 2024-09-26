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

                    {{-- <div class="col-lg-9">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title text-capitalize">Settings</h4>
                            </div>

                        </div>
                    <div class="card-header">
                     <form action="{{ route('admin.setting.store') }}" name="setting" method="POST"
                  enctype="multipart/form-data">
                     @csrf
                    <h3 class="mb-2 text-muted t_muted">Software Info :</h3>
                    <div class="">
                    <div class="form-group">
                        <label for="software_title">Title :</label>
                        <input type="hidden" value="{{ $setting->id ?? '' }}" name="id" id="id">
                        <input type="text" class="form-control" value="{{ $setting->software_title ?? '' }}"
                               name="software_title"
                               id="software_title">
                    </div>
                    <div class="form-group">
                        <label for="software_description">Description :</label>
                        <textarea class="form-control" name="software_description"
                                  id="software_description"
                                  style="min-height: 150px;">{{ $setting->software_description ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="software_version">Version :</label>
                        <input type="text" class="form-control" value="{{ !empty($setting->software_version) ? $setting->software_version : '' }}"
                               name="software_version" id="software_version" >
                    </div>

                </div>
                <hr/>
                <h3 class="mb-2 text-muted t_muted">Company Info :</h3>
                <div class="">
                    <div class="form-group">
                        <label for="company_name">Name :</label>
                        <input type="text" class="form-control" value="{{ $setting->company_name ?? '' }}"
                               name="company_name"
                               id="company_name">
                    </div>
                    <div class="form-group">
                        <label for="company_logo">Logo :</label>
                        <input type="file" class="form-control" value="{{ $setting->company_logo ?? '' }}"
                               name="company_logo"
                               id="company_logo">
                        @if (!empty($setting->company_logo))
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
                <h3 class="mb-2 text-muted t_muted">Billing Info :</h3>
                <div class="">
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
                <h3 class="mb-2 text-muted t_muted">Notification Emails :</h3>
                <div class="">
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
    </div> --}}

                    <div class="col-xl-12">

                        <!-- end card header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link active mb-2"
                                                    href="{{ route('admin.app.set') }}">General</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.company') }}">Company
                                                    Info</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.finance') }}">Finance</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.appkey') }}">App Keys</a>
                                                <!--                                                 <a class="nav-link mb-2" href="{{ route('admin.setting.index') }}">Software</a> -->
                                                <a class="nav-link mb-2"
                                                    href="{{ route('admin.app.miscellaneous') }}">Miscellaneous</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.media') }}">Media</a>
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
                                                    <h4 class="card-title text-capitalize">App Settings</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{ route('admin.app.store') }}" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">App Info :</h3>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="app_title">Title :</label>
                                                            <input type="hidden" value="{{ $app_setting->id ?? '' }}"
                                                                name="id" id="id">
                                                            <input type="text" class="form-control"
                                                                value="{{ $app_setting->title ?? '' }}" name="app_title"
                                                                id="app_title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="app_description">Description :</label>
                                                            <textarea class="form-control" name="app_description" id="app_description" style="min-height: 80px;">{{ $app_setting->description ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="app_version">Version :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->version) ? $app_setting->version : '' }}"
                                                                name="app_version" id="app_version">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="beta_url">Application Beta URLS :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->beta_url) ? $app_setting->beta_url : '' }}"
                                                                name="beta_url" id="beta_url">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="playstore_url">Play Store URL :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->playstore_url) ? $app_setting->playstore_url : '' }}"
                                                                name="playstore_url" id="playstore_url">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="appstore_url">Appstore URL :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->appstore_url) ? $app_setting->appstore_url : '' }}"
                                                                name="appstore_url" id="appstore_url">
                                                        </div>
                                                    </div>
                                                    {{-- <hr /> --}}
                                                    {{-- <h3 class="mb-2 text-muted t_muted">Company Info :</h3>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="company_name">Name :</label>
                                                        <input type="text" class="form-control" value="{{ $setting->company_name ?? '' }}"
                                                               name="company_name"
                                                               id="company_name">
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="app_logo">Logo :</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_setting->applogo ?? '' }}" name="app_logo"
                                                            id="app_logo">
                                                        @if (!empty($app_setting->applogo))
                                                            <img src="{{ url($app_setting->applogo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dark_logo">Dark Logo :</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_setting->dark_logo ?? '' }}" name="dark_logo"
                                                            id="dark_logo">
                                                        @if (!empty($app_setting->dark_logo))
                                                            <img src="{{ url($app_setting->dark_logo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fab_icon">Favicon Icon :</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_setting->favicon_logo ?? '' }}"
                                                            name="fab_icon" id="fab_icon">
                                                        @if (!empty($app_setting->favicon_logo))
                                                            <img src="{{ url($app_setting->favicon_logo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="company_intro">Introduction :</label>
                                                        <textarea class="form-control" style="min-height: 80px;" name="company_intro" id="company_intro">{{ $setting->company_intro ?? '' }}</textarea>
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="company_email">Email :</label>
                                                        <input type="email" class="form-control" value="{{ $setting->company_email ?? '' }}"
                                                               name="company_email"
                                                               id="company_email">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="company_alternative_email">Alternative Email :</label>
                                                        <input type="email" class="form-control" value="{{ $setting->company_alternative_email ?? '' }}"
                                                               name="company_alternative_email" id="company_alternative_email">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="company_contact_no">Contact No :</label>
                                                        <input type="number" class="form-control" value="{{ $setting->company_contact_no ?? '' }}"
                                                               name="company_contact_no" id="company_contact_no">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="company_alternative_contact_no">Alternative Contact No :</label>
                                                        <input type="number" class="form-control"
                                                               value="{{ $setting->company_alternative_contact_no ?? '' }}"
                                                               name="company_alternative_contact_no" id="company_alternative_contact_no">
                                                    </div> --}}

                                                    {{-- <div class="form-group">
                                                        <label for="company_gst_no">GST No :</label>
                                                        <input type="text" class="form-control" value="{{ $setting->company_gst_no ?? '' }}"
                                                               name="company_gst_no" id="company_gst_no">
                                                    </div> --}}
                                                    {{-- </div> --}}
                                                    {{-- <h3 class="mb-2 text-muted t_muted">Billing Info :</h3>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="billing_header">Header :</label>
                                                        <textarea class="form-control" name="billing_header"
                                                                  id="billing_header"
                                                                  style="min-height: 80px;">{{ $setting->billing_header ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="billing_footer">Footer Left:</label>
                                                        <textarea class="form-control" name="billing_footer"
                                                                  id="billing_footer"
                                                                  style="min-height: 80px;">{{ $setting->billing_footer ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="billing_footer">Footer Right:</label>
                                                        <textarea class="form-control" name="billing_footer1"
                                                                  id="billing_footer1"
                                                                  style="min-height: 80px;">{{ $setting->billing_footer1 ?? '' }}</textarea>
                                                    </div>
                                                </div> --}}
                                                    {{-- <h3 class="mb-2 text-muted t_muted">Notification Emails :</h3>
                                                <div class="">
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
                                                </div> --}}
                                                    {{-- <div class="col-sm-12 text-center">
                                                <button type="submit"
                                                    class="btn btn-primary add-list btn-md text-white">Save</button>
                                            </div> --}}


                                                    <h3 class="mb-2 text-muted t_muted">Billing Info :</h3>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="billing_header">Header :</label>
                                                            <textarea class="form-control" name="billing_header" id="billing_header" id="billing_header"
                                                                style="min-height: 150px;">{{ $app_setting->header ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="billing_footer">Footer Left:</label>
                                                            <textarea class="form-control" name="billing_footer" id="billing_footer" id="billing_footer"
                                                                style="min-height: 150px;">{{ $app_setting->footer_left ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="billing_footer">Footer Right:</label>
                                                            <textarea class="form-control" name="billing_footer1" id="billing_footer1" id="billing_footer1"
                                                                style="min-height: 150px;">{{ $app_setting->footer_right ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <h3 class="mb-2 text-muted t_muted">Notification Emails :</h3>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="email_cc">CC :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $app_setting->cc ?? '' }}" name="email_cc"
                                                                id="email_cc">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_bcc">BCC :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $app_setting->Bcc ?? '' }}" name="email_bcc"
                                                                id="email_bcc">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" class="btn btn-success btn-rounded"><i
                                                                class="uil uil-check me-2"></i> Update </button>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->

                    {{-- <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- </div>
    </div> --}}
    <script>
        // ClassicEditor
        //     .create(document.querySelector('#billing_header'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#billing_footer'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#billing_footer1'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#email_cc'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        //     .create(document.querySelector('#email_bcc'))
        //     .catch(error => {
        //         console.error(error);
        //     });
    </script>

@endsection

@section('scripts')
    <script>
        /* $('#generate_api_key').on('click', function () {
                    const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                    $('#api_key').val(id);
                }); */
    </script>
@endsection
