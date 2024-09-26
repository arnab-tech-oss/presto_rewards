@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Transaction')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Transaction History</h4>
                                </div>


                                {{-- <a class="btn btn-primary add-list btn-sm text-white" href="{{ route('admin.catalog.add') }}"><i class="las la-plus mr-3"></i>Add Catalog</a> --}}
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table   table-striped table-bordered " id="transaction_table">
                                        <thead>
                                            <tr class="ligth">
                                                <th>sys_id</th>
                                                <th>Transaction Type</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <!-- <th class="text-center">Action</th> -->
                                            </tr>
                                        </thead>
                                        {{-- <tbody>

                                            @foreach ($trans as $wallet)
                                                @foreach ($wallet->transaction as $tran)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $tran->transactiontype }}</td>
                                                        <td>{{ $tran->amount }}</td>
                                                        <td>{{ $tran->description }}</td>
                                                        <td>{{ $tran->date }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                        </tbody> --}}
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

    <script type="text/javascript">
        $(function() {
            var table = $('#transaction_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.transaction', ['id' => $cus_id]) }}",
                columns: [{
                        data: 'transaction',
                        //name: 'transaction.id',
                        render: function(data, type, row) {
                            var txt = '';
                            data.forEach(function(item) {
                                if (txt.length > 0) {
                                    txt += '</br>'
                                }
                                txt += item.id;
                            });
                            return txt;
                        }
                    },
                    {
                        data: 'transaction',
                        //name: "transaction.transactiontype",
                        render: function(data, type, row){
                            var txt = '';
                            data.forEach(function(item){
                                if (txt.length > 0) {
                                    txt += '</br>'
                                }
                                txt += item.transactiontype;
                            });
                            return txt;
                        }
                    },
                    {
                        // data: 'transaction.amount',
                        // name: 'transaction.amount',
                        data: 'amount',
                        name: 'amount',
                    },
                    {
                        data: 'transaction',
                        // name: 'transaction.description'
                        render: function(data, type, row){
                            var txt = '';
                            data.forEach(function(item){
                                if (txt.length > 0){
                                    txt += '</br>'
                                }
                                txt += item.description;
                            });
                            return txt;
                        }
                    },
                    {
                        data: 'transaction',
                        // name: 'transaction.date',
                        render: function(data, type, row){
                            var txt = '';
                            data.forEach(function(item){
                                if (txt.length > 0){
                                    txt += '</br>'
                                }
                                txt += item.date;
                            });
                            return txt;
                        }
                    },
                ]
            })
        })
    </script>

@endsection
