@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Company')
@section('content')
<div class="main-content">
    <div class="page-content" style="padding:35px 0 80px 0">
        <script>
            @if (Session::has('failure'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar" : true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.error("{{ session('failure') }}");
                @endif
            </script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div id="" class="">
                        <div class="card">
                            {{-- <a href="#addproduct-billinginfo-collapse" class="text-reset text-reset d-flex flex-grow-1" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse"> --}}
                                <div class="p-4">

                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Reply view</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                        <a href="{{route('admin.tic.list')}}">
                                            <button type="submit" class="btn btn-primary add-list btn-md btn-rounded" ><i class="uil-arrow-left me-2"></i>Back to comments List</button>
                                        </a>
                                        </div>
                                        <div class="flex-shrink-0">
                                            {{-- <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> --}}
                                        </div>
                                    </div>
                                </div>
                            {{-- </a> --}}

                            <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion" style="">
                                <div class="p-4 border-top">

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="type" class="required">Customer Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{$view_ticet->customer->first_name.' '.$view_ticet->customer->last_name}}" readonly>
                                                    @error('company_name')
                                                            <span class="text-danger">{{ $name }}</span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="role_id" class="required">Subject</label>
                                                    <input type="text" name="subject" class="form-control" placeholder="Enter Customer Last Name" value="{{$view_ticet->subject}}" readonly>
                                                    @error('brand_title')
                                                            <span class="text-danger">{{ $subject }}</span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Type</label>
                                                    <input type="text" name="type" class="form-control" placeholder="Enter Date Of Birth" name="type" value="{{$view_ticet->type}}" readonly>
                                                    @error('image')
                                                            <span class="text-danger">{{ $type }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            @foreach ($view_ticet->convertation as $convertation)
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="">Message</label>
                                                    <input type="text" name="message" class="form-control" name="ticket_no" value="{{$convertation->message }}" readonly>
                                                        @error('message')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="">Ticket No</label>
                                                    <input type="text" class="form-control"name="ticket_no" value="{{$view_ticet->ticket_no }}" readonly>
                                                        @error('ticket_no')
                                                            <span class="text-danger">{{ $ticket }}</span>
                                                        @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="">Status</label>
                                                    @php
                                                        if ($view_ticet->status == 'open') {
                                                          $status = "<span class='badge bg-success'>Open</span>";
                                                        } else if ($view_ticet->status == 'close') {
                                                          $status = "<span class='badge bg-danger'>Close</span>";
                                                        }

                                                    @endphp

                                                    <span style="font-size: 20px;"> {!! $status !!} </span>

                                                </div>
                                            </div>



                                            {{-- <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i>Add Company</button> --}}


                                </div>
                            </div>
                        </div>
                    </div>
            <div class="col-sm-12 text-center">
                <button type="submit"
                class="btn btn-success btn-rounded" ><i class="uil uil-check me-2"></i>Add Brand</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection


@if (session()->has('failure'))
  <div class="alert alert-danger">
   <script>
    alert('failure')
   </script>
  </div>
@endif
