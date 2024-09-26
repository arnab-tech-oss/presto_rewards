
<div class= "card card_content mb-0">
                      <form id="form_data" action="{{route('product.update',[$product_edit->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="type" class="required">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" placeholder="" value="{{$product_edit->product_name}}" readonly><input type="hidden" name="id" value="{{$product_edit->id}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="required">MRP</label>
                                            <input required="" type="text" class="form-control"
                                                placeholder="" value="{{$product_edit->price_range}}" name="price_range">

                                                @error('price_range')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                               


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <textarea type="text" class="form-control" placeholder="" name="description">{{$product_edit->description}}</textarea>

                                            @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 d-flex justify-content-center">
                                        <div class="form-group">
                                            <label class="optional">Image</label>
                                            <img src="{{asset($product_edit->image)}}" alt="Company Logo" class="img-fluid op_tional" width="150px">
                                            <input type="file" name="image" id="inputImage" class="form-control">

                                            @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i class="uil uil-check me-2"></i>Update Product</button>

                                    </div>
                                </div>

                            </form>
</div>
                     