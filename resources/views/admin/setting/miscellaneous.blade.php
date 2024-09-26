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
                                                <a class="nav-link mb-2" href="{{ route('admin.app.company') }}">Company
                                                    Info</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.finance') }}">Finance</a>
                                                <a class="nav-link mb-2" href="{{ route('admin.app.appkey') }}">App Keys</a>
<!--                                                 <a class="nav-link mb-2" href="{{route('admin.setting.index')}}">Software</a> -->
                                                <a class="nav-link active" href="{{ route('admin.app.miscellaneous') }}">Miscellaneous</a>
                                                <a class="nav-link" href="{{ route('admin.app.media') }}">Media</a>
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
                                                    <h4 class="card-title text-capitalize">Miscellaneous</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{ route('admin.post.miscellaneous') }}" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">Miscellaneous :</h3>

                                                    <div class="form-group">
                                                        <label for="s_key">Registrations Users Types :</label><br>

                                                        @foreach ($roles as $role)
                                                        @php
                                                            $isChecked = $role->usertype->isNotEmpty();
                                                        @endphp
                                                            <input type="checkbox" id="usr_type_{{ $role->id }}"
                                                                name="usr_type[]" value="{{ $role->id }}" {{ $isChecked ? 'checked' : '' }}>
                                                            <label
                                                                for="usr_type_{{ $role->id }}">{{ $role->role_name }}</label><br>
                                                        @endforeach

                                                    </div>


                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit"
                                                            class="btn btn-primary add-list btn-md text-white">Save</button>
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

            <script>
                $(document).ready(function() {
                    $("#generate").click(function() {
                        var randomNumber = generateRandom16DigitNumber();
                        $("#s_key").val(randomNumber);
                    });

                    function generateRandom16DigitNumber() {
                        var min = Math.pow(10, 15);
                        var max = Math.pow(10, 16) - 1;
                        return Math.floor(Math.random() * (max - min + 1)) + min;
                    }

                    $("#reset").click(function() {
                        $("#s_key").val("");
                    });

                });
            </script>
        @endsection

        {{-- @section('scripts') --}}
        {{-- <script>
         alert("ok"); --}}
        {{-- /* $('#generate_api_key').on('click', function () {
                const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                $('#api_key').val(id);
            }); */ --}}
        {{-- </script> --}}
        {{-- @endsection --}}
