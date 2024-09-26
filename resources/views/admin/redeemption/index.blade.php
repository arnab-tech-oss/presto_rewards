@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Redeemption')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><span id="type_list">Pending</span> List</h4>
                                </div>
                            </div>



                            <div class="card-body">
                                <div class="table-responsive-lg">


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="" style="padding: 0 0 10px 0">
                                                <select class="form-select" id='datastatus' name="datastatus">
                                                    {{-- <option>Select</option> --}}
                                                    <option value="pending" selected>Pending</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                <script>
                                    @if (Session::has('successs'))
                                        toastr.options = {
                                            "closeButton": true,
                                            "positionClass": "toast-top-center",
                                            "showDuration": "300",
                                        }
                                        toastr.success("{{ session('successs') }}");
                                    @endif
                                </script>
                                <table class=" datatable table   table-striped table-bordered " style="width: 100%">
                                    <thead>
                                        <tr class="ligth">
                                            <th class="text-center">
                                                <input type="checkbox" value="1" id="check_all" />
                                                Select All
                                            </th>
                                            {{-- <th>sys_id</th> --}}
                                            <th>Coupon No </th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Request Date</th>
                                            <th id="approve_date">Approve Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th id="reason">Reject Reason</th>
                                            <th id="action">Action</th>
                                        </tr>
                                    </thead>
                                    <div style="background: #fff; cursor: pointer; padding: 5px 10px;
                                            border: 1px solid #ccc;
                                            width: fit-content;
                                            margin: 0 auto -35px 575px;
                                            text-align: center;
                                            position: relative;
                                            z-index: 1;" >
                                        Total Customer: <span id="tc"></span> <span class="ps-3 d-inline-block">Total
                                            Amount: <span id="ta"></span></span>
                                    </div>
                                    <div id="daterange"
                                       style="background: #f8f7fc; cursor: pointer; padding: 5px 10px;
                                        width: fit-content;
                                        margin: 0 auto -35px 300px;
                                        text-align: center;
                                        position: relative;
                                       z-index: 1;
                                        border-radius: 0px 0px 0.25rem 0.25rem;"
                                        onmouseover="this.style.background='#d3d2d6'"
                                        onmouseout="this.style.background='#f8f7fc'">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span>
                                        {{-- <i class="fas fa-chevron-down"></i> --}}
                                        <i class="fas fa-chevron-down" style="opacity: .5; font-size: 13px; margin-left: 3px;"></i>
                                    </div>
                                    {{-- <div class="ps-15">
                                            Total Amount: 300
                                        </div> --}}
                                    <script type="text/javascript">
                                        $(function() {
                                            var table;

                                            $('#reason').hide();
                                            $('#action').hide();
                                            $('#approve_date').hide();

                                            var status = 'pending';
                                            let start_date = null;
                                                let end_date = null;

                                                if (start_date && end_date) {
                                                    $('#daterange span').html(start_date.format('MMMM D, YY') + '-' + end_date.format('MMMM D, YY'));
                                                } else {
                                                    $('#daterange span').html('Select Date Range');
                                                }

                                                $('#daterange').daterangepicker({
                                                    autoUpdateInput: false,
                                                }, function(start, end) {
                                                    start_date = start;
                                                    end_date = end;

                                                    $('#daterange span').html(start_date.format('MMMM D, YY') + '-' + end_date.format(
                                                        'MMMM D, YY'));
                                                    table.draw();
                                                });

                                            function initializeDataTable(status) {
                                                if (table) {
                                                    table.destroy();
                                                }
                                                if (status === 'rejected') {
                                                    $('#reason').show();
                                                } else {
                                                    $('#reason').hide();
                                                }
                                                if (status === 'pending') {
                                                    $('#action').show();
                                                } else {
                                                    $('#action').hide();
                                                }
                                                if (status === 'approved') {
                                                    $('#approve_date').show();
                                                } else {
                                                    $('#approve_date').hide();
                                                }
                                                table = $('.datatable').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: {
                                                        url: "{{ route('redeemption') }}",
                                                        data: function(d) {
                                                            d.status = status;
                                                            if (start_date && end_date) {
                                                                d.from_date = start_date.format('YYYY-MM-DD');
                                                                d.end_date = end_date.format('YYYY-MM-DD');
                                                            }
                                                        },
                                                        dataSrc:function(json){
                                                            $('#tc').text(json.total_customer);
                                                            $('#ta').text(json.total_amount);
                                                            return json.data;
                                                        }
                                                    },
                                                    buttons: [{
                                                        extend: 'collection',
                                                        text: 'Export',
                                                        buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                        className: 'custom-exp-btn',
                                                    }, ],
                                                    columns: [{
                                                            data: 'check',
                                                            name: 'check',
                                                            orderable: false,
                                                            searchable: false
                                                        },
                                                        // {
                                                        //     data: 'id',
                                                        //     name: 'id',
                                                        // },
                                                        {
                                                            data: 'coupon.coupon_code',
                                                            name: 'coupon.coupon_code',
                                                        },
                                                        {
                                                            data: 'customer.first_name',
                                                            name: 'customer.first_name',
                                                        },
                                                        {
                                                            data: 'customer.phone_number',
                                                            name: 'customer.phone_number',
                                                        },
                                                        {
                                                            data: 'request_date_time',
                                                            name: 'request_date_time',
                                                        },
                                                        {
                                                            data: 'updated_at',
                                                            name: 'updated_at',
                                                            render: function(data, type, full, meta) {
                                                                var date = new Date(data);
                                                                var formattedDate = date.getFullYear() + '-' +
                                                                    ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                                                                    ('0' + date.getDate()).slice(-2);

                                                                // Return the formatted date
                                                                return formattedDate;
                                                            }
                                                        },
                                                        // {
                                                        //     data: 'coupon.couponRequest.company.brand_title',
                                                        //     name: 'coupon.couponRequest.company.brand_title',
                                                        //     render: function(data, type, full, meta) {
                                                        //         return data ? data : '-';
                                                        //     }
                                                        // },
                                                        {
                                                            data: 'amount',
                                                            name: 'amount',
                                                        },
                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'pending') {
                                                                    return "<span class='badge bg-primary'>Pending</span>";

                                                                }
                                                                if (data.toLowerCase() == 'approved') {
                                                                    return "<span class='badge bg-success'>Approved</span>";


                                                                }
                                                                if (data.toLowerCase() == 'approved') {
                                                                    return "<span class='badge bg-success'>Approved</span>";
                                                                } else {
                                                                    return "<span class='badge bg-danger'>Rejected</span>";
                                                                }
                                                            }
                                                        },
                                                        {
                                                            data: 'admin_comment',
                                                            name: 'admin_comment',
                                                        },
                                                        {
                                                            data: 'action',
                                                            name: 'action',
                                                        },
                                                        // Add more columns as needed

                                                    ],

                                                    colReorder: true,
                                                    dom: 'lBfrtip',
                                                    lengthMenu: [
                                                        [10, 25, 50, -1],
                                                        [10, 25, 50, 100]
                                                    ],
                                                    select: true,
                                                    initComplete: function() {
                                                        var columnReason = table.column(8);
                                                        var columnAction = table.column(9);
                                                        var columnApproveDate = table.column(5);
                                                        var checkColumn = table.column(0);

                                                        columnReason.visible(false);
                                                        columnAction.visible(false);
                                                        columnApproveDate.visible(false);
                                                        checkColumn.visible(false);

                                                        if (status === 'rejected') {
                                                            columnReason.visible(true);
                                                        }

                                                        if (status === 'pending') {
                                                            columnAction.visible(true);
                                                            checkColumn.visible(true);
                                                        }

                                                        if (status === 'approved') {
                                                            columnApproveDate.visible(true);
                                                        }
                                                    }
                                                });
                                            }

                                            initializeDataTable(status);

                                            $('#datastatus').change(function() {
                                                status = $(this).val();
                                                if (status !== 'Select') {
                                                    initializeDataTable(status);
                                                    $('#type_list').text(capitalizeFirstLetter(status));
                                                }
                                            });

                                            function capitalizeFirstLetter(string) {
                                                return string.charAt(0).toUpperCase() + string.slice(1);
                                            }
                                        });
                                        // $('#datastatus').val('pending').trigger('change');
                                        /* custom script  */
                                        $("#check_all").click(function() {
                                            if ($(this).prop("checked")) {
                                                $("input[type=checkbox]").prop("checked", true);
                                                Swal.fire({
                                                    title: "Do you want to approved the coupon?",
                                                    showDenyButton: true,
                                                    showCancelButton: true,
                                                    confirmButtonText: "Yes! Approve",
                                                    denyButtonText: `No, Reject`
                                                }).then((result) => {
                                                    /* Read more about isConfirmed, isDenied below */
                                                    if (result.isConfirmed) {
                                                        allRedeemptionSend()
                                                        // Swal.fire("All Coupons are approved", "", "success");
                                                    } else if (result.isDenied) {
                                                        Swal.fire({
                                                            title: 'Reason for rejection',
                                                            input: 'textarea',
                                                            inputPlaceholder: 'Enter your reason here...',
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Submit',
                                                            cancelButtonText: 'Cancel'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                allRejectSend(result.value);
                                                            } else {
                                                                $("#check_all").prop("checked", false);
                                                                $("input[type=checkbox]").prop("checked", false);
                                                            }
                                                        });
                                                        //Swal.fire("All coupon are rejected", "", "danger");
                                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                        $("#check_all").prop("checked", false);
                                                        $("input[type=checkbox]").prop("checked", false);
                                                    }
                                                });
                                            }
                                            if (!$(this).prop("checked")) {
                                                $("input[type=checkbox]").prop("checked", false);
                                            }
                                        });

                                        function allRejectSend(rejectionReason) {
                                            var redeemptionValue = [];
                                            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                                            $("input:checkbox[name=redeemption]:checked").each(function() {
                                                redeemptionValue.push($(this).val());
                                            });
                                            if (redeemptionValue.length <= 0) {
                                                alert("Please select atleast one checkbox");

                                            } else {
                                                redeemptionValueStr = JSON.stringify(redeemptionValue);

                                                $.ajax({
                                                    url: "{{ route('request.all_reject') }}",
                                                    type: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        _token: csrfToken,
                                                        redeemptionReq: redeemptionValueStr,
                                                        rejectionReason: rejectionReason

                                                    },
                                                    success: function(data) {
                                                        Swal.fire("All coupon are rejected", "", "error").then(() => {
                                                            window.location.reload();
                                                        });
                                                    }
                                                });
                                            }
                                        }

                                        function allRedeemptionSend() {
                                            var redeemptionValue = [];
                                            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                                            $("input:checkbox[name=redeemption]:checked").each(function() {
                                                redeemptionValue.push($(this).val());
                                            });
                                            if (redeemptionValue.length <= 0) {
                                                alert("Please select atleast one checkbox");

                                            } else {
                                                redeemptionValueStr = JSON.stringify(redeemptionValue);

                                                $.ajax({
                                                    url: "{{ route('request.all_approved') }}",
                                                    type: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        _token: csrfToken,
                                                        redeemptionReq: redeemptionValueStr

                                                    },
                                                    success: function(data) {
                                                        Swal.fire("All Coupons are approved", "", "success").then(() => {
                                                            window.location.reload();
                                                        });
                                                    }
                                                });
                                            }
                                        }
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


    {{-- modal on reject button --}}
    <div class="modal fade bs-example-modal-center show" tabindex="-1" aria-labelledby="rejectModalLabel" aria-modal="true"
        role="dialog" id="reject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reason For Rejection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <label for="rejectionReason">Please provide a reason for rejection:</label>
                    <textarea class="form-control" id="rejectionReason" rows="4" name="reason"></textarea>
                    <div class="text-danger" id="resonerror"></div>
                    <div class="mt-3"> <!-- Add margin-top for spacing -->
                        <button type="button" class="btn btn-primary" id="submitreject">Submit</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


@endsection
