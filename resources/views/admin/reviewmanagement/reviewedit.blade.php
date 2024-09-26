@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Add Customer')
@section('content')

    <div class="main-content" style="padding:0px 0 70px 0">
        <div class="page-content">

            <div class= "card card_content mb-0">

                <form action="{{ route('admin.review.update', [$review_edit->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">Review Rating</label>
                                <input type="text" name="scale" required class="form-control"
                                    value="{{$review_edit->scale}}" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">Review Message</label>
                                <input type="text" name="reviewtext" class="form-control" required
                                    value="{{$review_edit->reviewtext}}" readonly>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="role_id" class="required">Status</label>
                                <select class="form-control" name="status">
                                    <option value="pending" {{ ($review_edit->status=='pending')?'selected':'' }}>Pending</option>
                                    <option value="reject" {{ ($review_edit->status=='reject')?'selected':'' }}>Reject</option>
                                    <option value="approve" {{ ($review_edit->status=='approve')?'selected':'' }}>Approve</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update
                                Review</button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>


@endsection
