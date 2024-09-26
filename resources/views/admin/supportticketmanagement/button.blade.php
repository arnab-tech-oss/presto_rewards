<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li> <a class="dropdown-item" href="{{ route('admin.ticket.view', $item->id) }}">View</a>
        <li><a class="dropdown-item" href="{{ route('support.comment.view', $item->id) }}">Reply</a></li>
        @if($item->status == 'open')
        <li><a class="dropdown-item" href="{{ route('admin.ticket.status', $item->id) }}">Close Ticket</a></li>
        @endif
    </ul>
</div>