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
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link mb-2" href="{{route('admin.app.set')}}">General</a>
                                                <a class="nav-link mb-2" href="{{route('admin.app.company')}}">Company Info</a>
                                                <a class="nav-link active mb-2" href="{{route('admin.app.finance')}}">Finance</a>
                                                <a class="nav-link mb-2" href="{{route('admin.app.appkey')}}">App Keys</a>
<!--                                                 <a class="nav-link mb-2" href="{{route('admin.setting.index')}}">Software</a> -->
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
                                                    <h4 class="card-title text-capitalize">Finance</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{ route('admin.app.store') }}" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">Finance Info :</h3>
                                                  
                                                        <div class="form-group">
                                                            <label for="currency">Currency :</label>
                                                            <input type="hidden" value="{{ $app_setting->id ?? '' }}"
                                                                name="id" id="id">
                                                            <input type="text" class="form-control"
                                                                value="{{ $app_setting->title ?? '' }}" name="currency"
                                                                id="currency">
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label for="bank_account">Bank Accounts :</label>
                                                            <input type="text" class="form-control"
                                                                value=""
                                                                name="bank_account" id="bank_account">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="terms_condition">Payment Term & Conditions :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->version) ? $app_setting->version : '' }}"
                                                                name="terms_condition" id="terms_condition">
                                                        </div>
                                                    
                                                  <div class="col-sm-12 text-center">
                                                        <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i> Update </button>
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

@endsection

@section('scripts')
    <script>
        /* $('#generate_api_key').on('click', function () {
                const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                $('#api_key').val(id);
            }); */
    </script>
@endsection
