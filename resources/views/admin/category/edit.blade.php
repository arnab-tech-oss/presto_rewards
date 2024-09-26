                          <form id="form_data" action="{{ route('category.update',[$data->id])}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="type" class="required">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $data->name }}">
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="">Product</label>
                                                <select class="form-control" name="products[]" multiple>
                                                    <option>Select One</option>
                                                    @foreach ($product as $item)
                                                        <option value="{{ $item->id }}">{{ $item->product_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="type">Description</label>
                                                <textarea name="description" class="form-control" placeholder="Enter Description" id="description">{{ $data->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional">Image</label>
                                                <img src="{{asset($data->image)}}" alt="Company Logo" class="img-fluid" width="150px">
                                                <br>
                                                <input type="file" name="image" id="inputImage" class="form-control">
                                            </div>
                                        </div>

                                        <div class="table-responsive-lg">
                                            <table class=" datatable table   table-striped table-bordered ">
                                                <thead>
                                                    <tr class="ligth">
                                                        <th>S.No</th>
                                                        <th>Product Name</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>

                                                <script type="text/javascript">
                                                    $(function() {
                                                                var categoryId = "{{ $data->id }}";
                                                                var table = $('.datatable').DataTable({
                                                                        processing: true,
                                                                        serverSide: true,
                                                                        ajax: {
                                                                            url: "{{ route('category.edit', ['id' => $data->id]) }}",
                                                                            type: 'GET',
                                                                        },
                                                                            columns: [{
                                                                                    data: 'DT_RowIndex',
                                                                                    name: 'DT_RowIndex',
                                                                                },
                                                                                {
                                                                                    data: 'product_name',
                                                                                    name: 'product_name',
                                                                                },
                                                                                {
                                                                                    data: 'description',
                                                                                    name: 'description'
                                                                                },
                                                                                {
                                                                                    data: 'image',
                                                                                    name: 'image',
                                                                                    orderable: false,
                                                                                    searchable: false,
                                                                                    render: function(data, type, full, meta) {
                                                                                        // Assuming 'logo' contains the image URL, render it as an image tag
                                                                                        return '<img src="' + data +
                                                                                            '" alt="Logo"  class="img-fluid" style="width:50px">';
                                                                                    }
                                                                                },
                                                                                {
                                                                                    data: 'action',
                                                                                    name: 'action'
                                                                                },
                                                                                // Add more columns as needed
                                                                            ]
                                                                        });
                                                                });
                                                </script>
                                            </table>
                                        </div>


                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update
                                                Category</button>
                                        </div>
                                    </div>
                                </form>
