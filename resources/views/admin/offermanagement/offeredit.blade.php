<div class= "card card_content mb-0">
<form id="form_data" action="{{route('admin.offer.update',[$offeredit->id])}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">Tittle</label>
                                                <input type="text"   class="form-control" name="title"
                                                    value="{{ $offeredit->title }}" >
                                            </div>

                                        </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="required">Start Date</label>
                                            <input type="datetime-local" name="start_date" class="form-control" placeholder="stat Date" value="{{$offeredit->start_date}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="required">End Date</label>
                                            <input type="datetime-local" name="end_date" class="form-control" placeholder="Enter Date" value="{{$offeredit->end_date}}">
                                        </div>
                                    </div> 


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <input type="text" class="form-control" name="description" value="{{$offeredit->description}}">
                                            <input type="hidden" name="id" value="{{$offeredit->id}}">
                                        </div>
                                    </div>
                                    </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional">Banner</label>
                                                <br>
                                                <img src="{{ asset($offeredit->baner)}}" alt="Company Logo" class="img-fluid" style="width: 200px;">
                                                <br>
                                                <input type="file" name="image" id="inputImage" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-center">
                                           <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i class="uil uil-check me-2"></i>Update Company</button>
                                            <script>
                                                $(document).ready(function() {
                                                $('.update-btn').submit(function(e) {
                                                e.preventDefault();
                                                // Show a custom confirmation dialog
                                                var confirmation = window.confirm('Are you sure you want to update this company?');
                                                // If user confirms, submit the form
                                                    if (confirmation) {
                                                        this.submit();
                                                    }
                                                    });
                                                });
                                            </script>

                                        </div>
                                    </div>

                                </form>
</div>
