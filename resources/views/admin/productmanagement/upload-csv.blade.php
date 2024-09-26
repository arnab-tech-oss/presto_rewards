@extends('admin.layout.app')
@push('css')
    .overlay{
    position: fixed;
    top: 0;
    width:100%;
    height:100%;
    background-color: rgba(0,0,0,0.5);
    display:none;
    }
    .loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    margin: auto;
    margin-top:20;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
@endpush
@push('js')
@endpush
@section('title', 'Bulk email')
@section('content')


    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="overlay">
        <div class="loader">
        </div>
    </div>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"> CSV Upload</h4>
                                </div>


                                <a class="btn btn-primary add-list btn-sm text-white" href=""><i
                                        class="las la-plus mr-3"></i>Back to
                                    List</a>
                            </div>

                            <!-- Modal body -->
                            <div class="card-body">
                                {!! Form::open(['url' => '/product/upload/csv', 'method' => 'post', 'files' => true]) !!}
                                <label>Upload File</label>
                                <input type = 'file' name='upload_file' id="upload_file">
                                <button type="button" onclick="csvupload()">upload</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function csvupload() {
        //alert('hii');
        var upload_file = $("#upload_file").val();
        if (upload_file == "") {
            alert("please select a file");
            return false;
        }

        var formData = new FormData();
        formData.append('upload_file', $("#upload_file")[0].files[0]);
        formData.append('_token', "{{ csrf_token() }}");

        $.ajax({
            type: "POST",
            url: "{{ url('/product/upload/csv') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false, // Set processData to false
            dataType: "json",
            beforeSend: function() {
                $('.overlay').css("display", "block");
            },
            success: function(res) {
                if (res.status == "success") {
                    alert(res.msg);
                    //console.log("Uploaded CSV Data:", res.data);
                }
            },
            error: function(error) {
                alert(error);
            },
            complete: function() {
                $('.overlay').css("display", "none");
            },
        });
    }
    // $("#productupload").on("submit", function(e) {
    //     e.preventDefault();
    //     alert('hii');

    // });
</script>
