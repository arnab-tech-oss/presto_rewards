<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><a class="dropdown-item" href="{{route('admin.wallet.transaction',$item->id)}}">View Trancsaction</a></li>
        {{-- <li><a class="dropdown-item" onclick="" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</a></li> --}}
    </ul>
</div>