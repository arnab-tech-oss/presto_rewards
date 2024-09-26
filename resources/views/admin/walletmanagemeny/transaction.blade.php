@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'wallet list')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <script>
                @if (Session::has('success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('success') }}");
                @endif

                @if (Session::has('update_success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "showDuration": "300",
                    }
                    toastr.success("{{ session('update_success') }}");
                @endif
            </script>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Wallet Transaction History</h4>
                                </div>


                                <!-- <a class="btn btn-primary add-list btn-sm text-white" href=""><i class="las la-plus mr-3"></i>Add Catalog</a> -->
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg table-responsive">
                                    <table class=" datatable table align-middle table-nowrap table-check" id="da">
                                        <thead>
                                            <tr class="ligth">
                                                <th>Wallet_id</th>
                                                <th>Customer Name</th>
                                                <th>Transaction Type</th>
                                                <th>Reference No</th>
                                                {{-- <th>Transaction ref no</th> --}}
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <!-- <th class="text-center">Action</th> -->
                                            </tr>
                                        </thead>
                                        <script type="text/javascript">
                                            $(function() {

                                                var table = $('#da').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.wallet.transaction', ['id' => $cus_id]) }}",

                                                    buttons: [{
                                                        extend: 'collection',
                                                        text: 'Export',
                                                        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                        className: 'custom-exp-btn',
                                                    }, ],

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'wallet.customer.first_name',
                                                            name: 'wallet.customer.first_name',
                                                        },
                                                        {
                                                            data: 'transactiontype',
                                                            name: 'transactiontype',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'cr') {
                                                                    return "<span class='badge bg-success'>Credited</span>";
                                                                } else {
                                                                    return "<span class='badge bg-danger'>Debited</span>";
                                                                }
                                                            }
                                                        },
                                                        {
                                                            data: 'refference_no',
                                                            name: 'refference_no',
                                                        },
                                                        {
                                                            data: 'amount',
                                                            name: 'amount',
                                                        },
                                                        {
                                                            data: 'description',
                                                            name: 'description'
                                                        },
                                                        {
                                                            data: 'date',
                                                            name: 'date'
                                                        },

                                                    ],
                                                    colReorder: true,
                                                    dom: 'lBfrtip',
                                                    lengthMenu: [
                                                        [10, 25, 50, -1],
                                                        [10, 25, 50, 100]
                                                    ],
                                                    select: true,
                                                });
                                            });
                                        </script>
                                    </table>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div>

@endsection
