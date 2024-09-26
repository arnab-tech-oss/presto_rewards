@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', $page)
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
                                    <h4 class="card-title text-capitalize">Add Catelog</h4>
                                </div>
                                <a href="{{ route('admin.catalog') }}">
                                    <button type="submit" class="btn btn-primary add-list btn-md btn-rounded"><i
                                            class="uil-arrow-left"></i>Back to Catelog List</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <form id="form_data" action="{{route('admin.catelogstore')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Catalogue Name</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Catalogue Name" name="name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Catalogue File</label>
                                                <input type="file" name="file" id="inputImage" class="form-control">
                                                @error('file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="required">Catalogue Cover</label>
                                                <input type="file" name="cover_file" id="inputImage" class="form-control">
                                                @error('cover_file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional">Catalogue Description</label>
                                                <textarea type="text" class="form-control" placeholder="Enter description" name="description"></textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i
                                                    class="uil uil-check me-2"></i>Add
                                                Catalogue</button>
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
