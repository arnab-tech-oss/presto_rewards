@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Enqury Panel')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title text-capitalize">Enquiry Answare by Admin</h4>
                            </div>


                            <a class="btn btn-primary add-list btn-sm text-white"
                                href="{{route('admin.enquiry',[$enquiryread->id])}}"><i class="las la-plus mr-3"></i>Back to Enquiry List</a>
                        </div>

                        <div class="card-body">
                            <form id="form_data" action="{{route('customer.reply',[$enquiryread->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="type" class="required">Customer Name</label>
                                            <input type="text" class="form-control" name="" placeholder="" value="{{$enquiryread->customer->full_name}}">
                                            <input type="hidden" class="form-control" name="product_name" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="required">Subject</label>
                                            <input type="text" class="form-control" name="" placeholder="" value="{{$enquiryread->subject}}">
                                        </div>
                                    </div>


                                    {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Price</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="{{$product_edit->mrp_price}}" name="mrp_price">
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Price Range</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="{{$product_edit->price_range}}" name="price_range">

                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Brand</label>
                                            <select id="type" required="" type="text" class="form-control"
                                                name="type" >
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div> --}}


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional">Message</label>
                                            <textarea type="text" class="form-control" placeholder="" name="" readonly>{{$enquiryread->message}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="optional">Reply</label>
                                            <textarea type="text" class="form-control" placeholder="" name="reply" required></textarea>
                                        </div>
                                    </div>                                    

                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary add-list btn-sm text-white">Reply</button>
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