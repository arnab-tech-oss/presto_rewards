                             <form id="form_data" action="" method=""  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="type">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $viewcat->name }}" readonly>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="">Product</label>
                                                <select class="form-control" name="products[]" multiple>
                                                    <option>Select One</option>
                                                    @foreach ($viewcat as $item)
                                                        <option value="{{ $item->id }}">{{ $item->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="type">Description</label>
                                                <textarea name="description" class="form-control" id="description" readonly>{{ $viewcat->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional">Image</label>
                                                <br>
                                                <img src="{{asset($viewcat->image)}}" alt="Company Logo" class="img-fluid" style="width: 200px;">
                                            </div>
                                        </div>
                                      
                                    </div>
                                </form>