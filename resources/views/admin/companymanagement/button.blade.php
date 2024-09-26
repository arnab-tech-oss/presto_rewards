
   {{-- <div class="btn-group"> --}}
    {{-- <button type="button" class="btn btn-primary btn-sm tooltip1" style="background-color: rgb(233, 236, 26)
    onclick="editForm('{{ route('company.view',$item->id) }}', 'show_form')"    data-bs-toggle="modal" data-bs-target="#show">
        <i class="fas fa-eye"></i> <span> View {{ $page }} </span>
    </button> --}}
    {{-- <a href="{{ route('company.view',$item->id) }}" class="btn btn-primary btn-sm tooltip1" style="background-color: rgb(233, 236, 26)"><i class="fas fa-eye"></i> <span> View {{ $page }} </span></a> --}}

    {{-- <button type="button" class="btn btn-warning btn-sm tooltip1" onclick="" data-bs-toggle="modal"
        data-bs-target="{{ route('admin.company.edit', ['id' => $item->id]) }}">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </button> --}}

    {{-- <a href="{{ route('admin.company.edit',  $item->id) }}" class="btn btn-warning btn-sm tooltip1">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </a> --}}

{{-- 
    <button type="button"
        onclick="changeStatus('{{ route('company.status', ['id' => $item->id]) }}', 'status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm tooltip1">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
            <span> DeActivate {{ $page }} </span>
        @else
            <i class="fas fa-times-circle"></i>
            <span> Activate {{ $page }} </span>
        @endif
    </button>
    </div> --}}

    <div class="dropdown text-center">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="uil uil-ellipsis-h"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="">
            <li><button class="dropdown-item" onclick="editForm( '{{route('company.view',$item->id)}}','modal_body')" data-bs-target="#view_modal" data-bs-toggle="modal" href="#">View</button></li>
            <li><button class="dropdown-item" onclick="editForm( '{{route('admin.company.edit',$item->id)}}','edit_modal_body')" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</button></li>
            <li><button class="dropdown-item" onclick="delete_entity( '{{route('company.delete',$item->id)}}')"  data-id="'.$row->id'">Delete</button></li>
       </ul>
    </div>