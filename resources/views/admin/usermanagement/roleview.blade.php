<form id="form_data" action="" method=""  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Role Name</label>
                <input type="text" name="name" class="form-control" value="{{$user->role_name}}" readonly>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="type">Description</label>
                <textarea name="description" class="form-control" id="description" readonly>{{$user->description}}</textarea>
            </div>
        </div>

      
    </div>
</form>