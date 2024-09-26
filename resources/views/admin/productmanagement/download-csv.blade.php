@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Bulk email')
@section('content')


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">CSV Download</h4>
                            </div>


                            <a class="btn btn-primary add-list btn-sm text-white"
                                href="#"><i class="las la-plus mr-3"></i>Back to
                                 List</a>
                        </div>

                        <!-- Modal body -->
                        <div class="card-body">
                            <form id="form_data" action="" method="POST"
                                enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <hr>
                                    <div id="show-msg"></div>
                                    <div class="col-sm-12 mt-3 text-center">
                                        <a href="{{route('product.csv.download')}}" type="button"
                                            class="btn btn-primary mt-2">Download Product CSV</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
