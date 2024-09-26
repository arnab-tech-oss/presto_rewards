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
                                             value="{{$user->phone }}" name="" readonly>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="">Address </label>
                                            <input required="" type="text" class="form-control"
                                            value="{{$user->address->address_1}}" name="" readonly>

                                        </div>
                                    </div>
                            </div>