@extends('admin.layout.app')
@push('css')
@endpush
@push('js')


@endpush
@section('title', 'Add pages')
@section('content')
    <div class="main-content">
        <div class="page-content">
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Create Pages by Admin</h4>
                                </div>
                                
                                <div class="flex-shrink-0">
                                    <a href="{{route('admin.setting.showdata')}}">
                                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded"><i class="uil-arrow-left me-2"></i>Back to Setting Page</button>
                                    </a>
                                    </div>

                                <!-- <a class="btn btn-primary add-list btn-sm text-white" -->
                                    <!-- href="{{route('admin.setting.showdata')}}"><i class="las la-plus mr-3"></i>Back to Setting Page</a> -->
                            </div>

                            <div class="card-body">
                                <form id="form_data" action="{{route('admin.setting.addpages')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Tittle</label>
                                                <input type="text" name="tittle" class="form-control" placeholder="tittle">
                                                @error('tittle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="type" class="required">Description</label>
                                                <textarea name="description" class="form-control" placeholder=" Description" id="description"></textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Add Page</button>    
                                        </div>
                                    </div>
                                   



                                </form>
                            </div>
                        </div>
                    </div>

                    <script src=""></script>

                    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>

                </div>
            </div>
        </div>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection