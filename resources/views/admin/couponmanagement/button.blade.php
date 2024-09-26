{{-- <div class="btn-group">
    <a href="{{ route('admin.coupon.view',$item->id) }}" class="btn btn-primary btn-sm tooltip1" style="background-color: rgb(233, 236, 26)"><i class="fas fa-eye"></i> <span> View Coupon </span></a>

    <a onclick="window.open('{{ route('admin.coupon.pdf', [$item->id]) }}', '_blank'); return false;" class="btn btn-warning btn-sm tooltip1">
        <i class="fas fa-download"></i> <span> Download Coupon </span>
    </a>

</div> --}}

<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><a class="dropdown-item" href="{{ route('admin.coupon.view',$item->id) }}">View</a></li>
        <li><a class="dropdown-item"  onclick="window.open('{{ route('admin.coupon.pdf', [$item->id]) }}', '_blank'); return false;">Download</a></li>
    </ul>
</div>