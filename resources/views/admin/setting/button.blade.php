<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        {{-- <li><button class="dropdown-item" onclick="" data-bs-target="#view_modal" data-bs-toggle="modal" href="#">View</button></li>
        <li><button class="dropdown-item" onclick="" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</button></li> --}}
        <li><button class="dropdown-item" onclick="delete_entity( '{{route('page.delete',$item->id)}}')"  data-id="'.$row->id'">Delete</button></li>
   </ul>
</div>