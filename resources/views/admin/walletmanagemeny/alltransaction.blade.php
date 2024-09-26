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
                                    <h4 class="card-title">All Wallet Transaction History</h4>
                                </div>


                                <!-- <a class="btn btn-primary add-list btn-sm text-white" href=""><i class="las la-plus mr-3"></i>Add Catalog</a> -->
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="datatable table align-middle table-nowrap table-check" id="datat">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Customer Name</th>
                                                <th>Customer Phone no</th>
                                                <th>Transaction Type</th>
                                                <th>Wallet ID</th>
                                                <th>Transaction Date</th>
                                                <th>Transaction Amount</th>
                                                <th>Action</th>
                                                <!-- <th class="text-center">Action</th> -->
                                            </tr>
                                        </thead>

                                        <script type="text/javascript">
                                            $(function() {


                                                var table = $('#datat').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.all.trans') }}",

                                                    order: [
                                                        [0, 'desc']
                                                    ],

                                                    buttons: [
                                                        {
                                                             extend: 'collection',
                                                             text:    'Export',
                                                             buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                             className: 'custom-exp-btn',
                                                        },
                                                    ],

                                                    columns: [{
                                                            data: 'id',
                                                            name: 'id',
                                                        },
                                                        {
                                                            data: 'wallet.customer.first_name',
                                                            name: 'wallet.customer.first_name',
                                                        },
                                                        {
                                                            data: 'wallet.customer.phone_number',
                                                            name: 'wallet.customer.phone_number'
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data == 'CREDITED') {
                                                                    return "<span class='badge bg-success'>Credited</span>";
                                                                } else if (data == 'REVERSED') {
                                                                    return "<span class='badge bg-danger'>Reversed</span>";
                                                                } else {
                                                                    return "<span class='badge bg-primary'>Debited</span>";
                                                                }
                                                            }
                                                        },
                                                        {
                                                            data: 'wallet_id',
                                                            name: 'wallet_id'
                                                        },
                                                        {
                                                            data: 'date',
                                                            name: 'date'
                                                        },
                                                        {
                                                            data: 'amount',
                                                            name: 'amount',
                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                        }

                                                    ],
                                                    colReorder: true,
                                                        dom: 'lBfrtip',
                                                        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
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

    {{-- -------------------------------------------View Mdal------------------------ --}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="view_modal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <h5 class="modal-title" id="myLargeModalLabel">View Transection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body" id="modal_body">

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{-- ---------------------- View Mdal End------------------------------------------------------------- --}}

@endsection

{{--
<tbody>

    @foreach ($alltrans as $trans)
        <tr>
            <td>{{$trans->id}}</td>
            <td>{{$trans->transactiontype}} </td>
            <td>{{$trans->amount}}</td>
            <td>{{$trans->description}}</td>
            <td>{{$trans->date}}</td>

            <script>
                $(document).ready(function() {
                    $('.delete-btn').on('click', function(e) {
                        e.preventDefault();

                        // Show a custom confirmation dialog
                        var confirmation = window.confirm('Are you sure you want to deactivate this company?');

                        // If user confirms, navigate to the delete URL
                        if (confirmation) {
                            var url = $(this).attr('href');
                            window.location.href = url;
                        }
                    });
                });
            </script>


</tr>
@endforeach
</tbody> --}}
