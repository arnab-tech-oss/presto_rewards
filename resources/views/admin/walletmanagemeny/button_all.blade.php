<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><button class="dropdown-item" onclick="editForm( '{{route('wallate.transection.view',$item->id)}}','modal_body')" data-bs-target="#view_modal" data-bs-toggle="modal" href="#">View transection Details</button></li>
    </ul>
</div>