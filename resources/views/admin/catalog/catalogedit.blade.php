<div class= "card card_content mb-0">
                      <form id="form_data" action="{{ route('admin.catalog.update', [$catalogedit->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="type" class="required">catalogue Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $catalogedit->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="role_id">Description</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Enter your Brand name"
                                                    value="{{ $catalogedit->description }}">
                                            </div>
                                        </div>



                                        {{-- <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="required">Status</label>
                                            <select class="form-control"
                                                name="status" >
                                                <option value="selectValue" disabled selected hidden>{{$catalogedit->status}}</option>
                                                <option value="active" select>Active</option>
                                                <option value="inactive" select>Inactive</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                        <div class="col-sm-4 d-flex justify-content-center">
                                            <div class="form-group">
                                                <label class="optional">Catalog Icon</label>
                                                <img src="{{ asset($catalogedit->image) }}" alt="Company Logo"
                                                    class="img-fluid op_tional" width="150px"> 
                                                <input type="file" name="image" id="inputImage" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Catalog Products</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive-lg">
                                                            <table class="datatable table table-striped table-bordered">
                                                                <thead>
                                                                    <tr class="ligth">
                                                                        <th>S.No</th>
                                                                        <th>Product Name</th>
                                                                        <th>Description</th>
                                                                        <th>Image</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- You can loop through your products data and populate the table rows accordingly -->
                                                                    @foreach ($catalogedit->product as $product)
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ $product->product_name }}</td>
                                                                            <td>{{ $product->description }}</td>
                                                                            <td>
                                                                                <img src="{{ asset($product->image) }}"
                                                                                    alt="Product Image" class="img-fluid">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                 <a href="{{route('catalog.product.delete',['id' => $product->id])}}" class="btn btn-primary btn-sm">Delete</a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update button section -->
                                        <div class="col-sm-12 text-center mt-4">
                                            <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i class="uil uil-check me-2"></i>Update Catalog</button>

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
