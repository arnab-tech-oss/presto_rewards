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
                                    <h4 class="card-title">Wallet List</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class=" datatable table align-middle table-nowrap table-check" id="datatabl">
                                        <thead>
                                            <tr class="ligth">
                                                <th>wallet id</th>
                                                <th>Customer Name</th>
                                                <th>Phone Number</th>
                                                <th>Balance</th>
                                                <th>Lifetime Credit</th>
                                                <th>Lifetime Debit</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>


                                        <script type="text/javascript">
                                            $(function() {



                                                var table = $('#datatabl').DataTable({

                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: "{{ route('admin.walletmanagement.list') }}",

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
                                                            data: 'walletlist.first_name',
                                                            name: 'walletlist.first_name',
                                                        },
                                                        {
                                                            data: 'walletlist.phone_number',
                                                            name: 'walletlist.phone_number',
                                                        },
                                                        {
                                                            data: 'balance',
                                                            name: 'balance'
                                                        },
                                                        {
                                                            data: 'lifetime_credit',
                                                            name: 'lifetime_credit'
                                                        },
                                                        {
                                                            data: 'lifetime_debit',
                                                            name: 'lifetime_debit'
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            // render: function(data, type, full, meta) {
                                                            //     if (data.toLowerCase() == 'active') {
                                                            //         return "<span class='badge bg-success'>Active</span>";
                                                            //     } else {
                                                            //         return "<span class='badge bg-danger'>Inactive</span>";
                                                            //     }
                                                            // }
                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action'
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


{{--

<tbody>
    @foreach ($wallets as $wallet)
      <tr>
          <td>{{$loop->iteration}}</td>
          <td>{!!$wallet->walletlist->first_name!!}   {!!$wallet->walletlist->last_name!!}</td>
          <td>{{$wallet->walletlist->phone_number}}</td>
          <td>{{$wallet->balance}}</td>
          <td>{{$wallet->lifetime_credit}}</td>
          <td>{{$wallet->lifetime_debit}}</td>
          <td class="text-center">
              <!-- Add action buttons here -->

              @if ($wallet->status == 'active')
              <a href="{{route('admin.wallet.status',[$wallet->customer_id])}}" class="btn btn-danger btn-sm delete-btn" id="deleteRoleBtn"><i
                  class="fas fa-ban"></i> Deactivate</a>
              @else
              <a href="{{route('admin.wallet.status',[$wallet->customer_id])}}" class="btn btn-danger btn-sm"><i
                  class="fas fa-ban"></i>Activate</a>
               @endif

               <a href="{{route('admin.wallet.transaction',[$wallet->id])}}" class="btn btn-success btn-sm" id="deleteRoleBtn"><i
                  class="fas fa-ban"></i>Transaction</a>

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


          </td>
      </tr>
    @endforeach
  </tbody> --}}
