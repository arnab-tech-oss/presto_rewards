<div class= "card card_content mb-0">
                              <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="type">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" placeholder="" value="{{$editproduct->product_name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label >MRP</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="" value="{{$editproduct->price_range}}" name="price_range" readonly>
                                        </div>
                                    </div>

                               


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <textarea type="text" class="form-control" placeholder="" name="description" readonly>{{$editproduct->description}}</textarea>

                                        </div>
                                    </div>

                                    <div class="col-sm-6 d-flex justify-content-center">
                                        <div class="form-group">
                                            <label class="optional">Image</label>

                                            <img src="{{asset($editproduct->image)}}" alt="Company Logo" class="img-fluid op_tional" width="150px">              
          

                                        </div>
                                    </div>


                                  
                                </div>
</div>
