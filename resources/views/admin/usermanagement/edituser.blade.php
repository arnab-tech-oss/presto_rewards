
                        <div class="card-body">
                            <form id="form_data" action="{{route('user.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="type" class="">User Name</label>
                                            <input type="text" class="form-control" name="product_name" value="{{strtoupper($user->full_name)}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role_id" class="">Email Id</label>
                                            <input type="email" class="form-control" value="{{$user->email}}" readonly>
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="">Mobile Number</label>
                                            <input required="" type="text" class="form-control"
                                             value="{{$user->phone }}" name="phone" >
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Address </label>
                                            <input required="" type="text" class="form-control"
                                            value="{{$user->address->address_1}}" name="address_1">

                                        </div>
                                    </div>

                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary add-list btn-sm text-white">update User</button>
                                    </div>
                                </div>

                            </form>
                        </div>