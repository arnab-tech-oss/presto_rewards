<div class= "card card_content mb-0">
    <form id="form_data" action="{{ route('admin.catalog.update', [$catalogedit->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="type" class="required">Catalog Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $catalogedit->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-8 d-flex justify-content-center">
                <div class="form-group">
                    <label class="optional">Catalog File</label>
                    @if ($catalogedit && pathinfo($catalogedit->image, PATHINFO_EXTENSION) === 'pdf')
                        <iframe src="{{ asset($catalogedit->image) }}" width="100%" height="600px">
                            This browser does not support PDFs. Please download the PDF to view it:
                            <a href="{{ asset($catalogedit->image) }}">Download PDF</a>
                        </iframe>
                    @else
                        <img src="{{ asset($catalogedit->image) }}" alt="Catalog Image" class="img-fluid">
                    @endif
                    <input type="file" name="file" id="inputImage" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="role_id">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter your Brand name"
                        value="{{ $catalogedit->description }}">
                </div>
            </div>
            <div class="col-sm-12 text-center mt-4">
                <button type="submit" class="btn btn-primary add-list btn-md btn-rounded mb-2"><i
                        class="uil uil-check me-2"></i>Update Catalog</button>
            </div>
    </form>
</div>
