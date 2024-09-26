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
                                                <a class="nav-link mb-2" href="{{ route('admin.app.set') }}">General</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.company') }}">Company Info</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.finance') }}">Finance</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.appkey') }}">App Keys</a>
<!--                                            <a class="nav-link mb-2" href="{{route('admin.setting.index')}}">Software</a> -->
                                                <a class="nav-link mb-2" href="{{ route('admin.app.miscellaneous') }}">Miscellaneous</a>
                                                <a class="nav-link mb-2 active" href="{{ route('admin.app.media') }}">Media</a>
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
                                                    <h4 class="card-title text-capitalize">Media Libery</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{route('admin.post.media')}}" name="app_media"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">Media :</h3>

                                                    <div class="form-group">
                                                        <label for="media_1">welcome Screen:</label>
                                                        <input type="hidden" value="{{ $app_media->id ?? '' }}"
                                                        name="id" id="id">
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_media->media_1 ?? '' }}" name="media_1"
                                                            id="media_1">
                                                        @if (!empty($app_media->media_1))
                                                            <img src="{{ url($app_media->media_1) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="media_2">Slider-1:</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_media->media_2 ?? '' }}" name="media_2"
                                                            id="media_2">
                                                        @if (!empty($app_media->media_2))
                                                            <img src="{{ url($app_media->media_2) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="media_3">Slider-2:</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_media->media_3 ?? '' }}" name="media_3"
                                                            id="media_3">
                                                        @if (!empty($app_media->media_3))
                                                            <img src="{{ url($app_media->media_3) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="media_4">Slider-3:</label>
                                                        <input type="file" class="form-control"
                                                            value="{{ $app_media->slider_4 ?? '' }}" name="media_4"
                                                            id="media_4">
                                                        @if (!empty($app_media->slider_4))
                                                            <img src="{{ url($app_media->slider_4) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
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
          
        @endsection
