<div class= "card card_content mb-0">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Catalogue Name</label>
                <input type="text" class="form-control" name="name" value="{{ $viewcatalog->name }}" readonly>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="role_id">Description</label>
                <textarea class="form-control" name="description" readonly> {{ $viewcatalog->description }} </textarea>
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

        <div class="col-sm-4">
            <div class="form-group">
                <label class="optional">catalogue Icon</label>
                <img src="{{ asset($viewcatalog->image) }}" alt="Company Logo" class="img-fluid">
            </div>
        </div>

        {{-- <div class="row mt-4">
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
    </div> --}}

    </div>
</div>
