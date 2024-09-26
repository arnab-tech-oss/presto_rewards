<form id="form_data" action="{{route('update.role')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Role Name</label>
                <input type="text" name="name" class="form-control" value="{{$edit_user->role_name}}" >
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="type">Description</label>
                <textarea name="description" class="form-control" id="description">{{$edit_user->description}}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update Role</button>
      
    </div>
</form>