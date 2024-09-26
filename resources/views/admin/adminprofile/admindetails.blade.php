@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Admin')
@section('content')

<script>
                @if (Session::has('update'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('update') }}");
                    @endif
</script>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2">
                </div>


                  @foreach($users as $user)

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="user-profile-img">
                                <img src="assets/images/pattern-bg.jpg" class="profile-img profile-foreground-img rounded-top" style="height: 120px;" alt="">
                                <div class="overlay-content rounded-top">
                                    <div>
                                        <div class="user-nav p-3">
                                            <div class="d-flex justify-content-end">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal font-size-20 text-white"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                                        <li><button class="dropdown-item" onclick="editForm( '{{route('admin.edit',$user->id)}}','edit_modal_body')" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end user-profile-img -->

                            <div class="mt-n5 position-relative">
                                <div class="text-center">
                                    <img src="{{ asset('assets') }}/images/users/avatar-3.jpg.svg" alt="" class="avatar-xl rounded-circle img-thumbnail">

                                    <div class="mt-3">
                                        <h5 class="mb-1">{{$user->full_name}}</h5>
                                        <div>
                                            <div class="badgebg-success-subtle text-success m-1">{{$user->user_type}}</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Portfolio</h5>

                            <div>
                                <ul class="list-unstyled mb-0 text-muted">
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-account-circle font-size-16 text-reset me-1"></i> Name
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user ->full_name}}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-email font-size-16 text-reset me-1"></i> Email
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user ->email}}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-phone-classic font-size-16 text-info me-1"></i> Phone Number
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->phone}}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-account font-size-16 text-primary me-1"></i> User Type
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->user_type}}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center pt-2 pb-1">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-map-marker font-size-16 text-danger me-1"></i> Address
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->address->address_1 ?? 'null'}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center pt-2 pb-1">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-map-marker-outline font-size-16 text-danger me-1"></i> State
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->address->state ?? 'null'}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center pt-2 pb-1">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-map-marker font-size-16 text-danger me-1"></i> District

                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->address->district ?? 'null'}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center pt-2 pb-1">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-map-marker-outline font-size-16 text-danger me-1"></i> PIN
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{$user->address->postal_code ?? 'null'}}</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                @endforeach
                       
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="edit_modal" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title" id="myLargeModalLabel">Update Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit_modal_body">
               
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
