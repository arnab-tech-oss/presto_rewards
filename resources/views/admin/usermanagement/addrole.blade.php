@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Role')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <script>
                @if (Session::has('roll_failure'))
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.error("{{ session('roll_failure') }}");
                @endif
            </script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title text-capitalize">Create Role by Admin</h4>
                                </div>                   
                                  
                                  <div class="flex-shrink-0">
                                    <a href="{{route('admin.role')}}">
                                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left"></i>Back to User List</button>
                                    </a>
                                 </div>  
                            </div>

                            <div class="card-body">
                                <form id="form_data" action="{{ route('post.role') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Role Name</label>
                                                <input type="text" name="role_name" class="form-control" placeholder="Role name">
                                                @error('role_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="type" class="required">Description</label>
                                                <textarea  name="description" class="form-control" placeholder="Role Description"></textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded" ><i class="uil uil-check me-2"></i>Add Role</button>
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
