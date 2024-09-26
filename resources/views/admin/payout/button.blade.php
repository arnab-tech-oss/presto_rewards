<div class="dropdown d-inline-block">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-file-alt"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><a class="dropdown-item" target="_blank" href="{{ route('transaction.document', [$item->id]) }}">Download
                PDF</a></li>
        <li><button class="dropdown-item" onclick="editForm('{{ route('transaction.view', $item->id) }}','modal_body')"
                data-bs-target="#view_modal" data-bs-toggle="modal">View</button></li>
    </ul>
</div>
