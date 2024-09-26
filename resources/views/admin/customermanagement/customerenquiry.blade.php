@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Customer Management')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Customer Details</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive-lg">
                                    <table class=" datatable table   table-striped table-bordered ">
                                        <thead>
                                            <tr class="ligth">
                                                <th>S.No</th>
                                                <th>Customer Name</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $entry)
                                                
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$entry->customer->full_name}}</td>
                                                <td>{{$entry->subject}}</td>
                                                <td>{{$entry->message}}</td>
                                                <td>{{$entry->date}}</td>
                                                <td>{{$entry->status}}</td>
                                                <td class="text-center">
                                                    <!-- Add action buttons here -->
                                                    <a href="{{route('admin.enquire.read',[$entry->id])}}" class="btn btn-primary btn-sm"><i
                                                            class="fas fa-edit"></i>Read</a>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>

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
