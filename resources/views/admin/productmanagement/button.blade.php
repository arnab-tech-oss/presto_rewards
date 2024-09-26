

    {{-- <a href="{{Route('admin.view.product',['id' => $item->id])}}"><button type="button" class="btn btn-primary btn-sm tooltip1" style="background-color: #cc99ff" onclick=""
        data-bs-toggle="modal" data-bs-target="#view">
        <i class="fas fa-eye"></i> <span> View {{ $page }} </span>
    </button></a> --}}

   

    {{-- <a href="{{ route('product.edit',['id' => $item->id]) }}" class="btn btn-warning btn-sm tooltip1">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </a>
    


    <button type="button"
        onclick="changeStatus('{{ route('product.status', ['id' => $item->id]) }}', 'status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm tooltip1">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
            <span> DeActivate {{ $page }} </span>
        @else
            <i class="fas fa-times-circle"></i>
            <span> Activate {{ $page }} </span>
        @endif
    </button> --}}


    <div class="dropdown text-center">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="uil uil-ellipsis-h"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="">
            <li><a class="dropdown-item" onclick="editForm( '{{route('admin.view.product', $item->id)}}', 'modal_body')"  data-bs-target="#view_modal" data-bs-toggle="modal">View</a></li>
            <li><a class="dropdown-item" onclick="editForm('{{route('product.edit', $item->id)}}','edit_modal_body')" data-bs-target="#edit_modal" data-bs-toggle="modal">Edit</a></li>
            <li><button class="dropdown-item" onclick="delete_entity('{{ route('product.delete',$item->id) }}')" data-id="'.$row->id'">Delete</button></li>
        </ul>
    </div>