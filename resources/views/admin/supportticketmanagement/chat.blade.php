@extends('admin.layout.app')
@push('css')
@endpush
@push('js')
@endpush
@section('title', 'Customer Enquiry')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="body">
                    <div class="card ">
                        <div class="card-header py-2 d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Support</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('message.post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- wizard-nav -->

                                <div class="wizard-tab" style="display: block;">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input" class="form-label">Ticket
                                                        No</label>
                                                    <input type="text" class="form-control" id=""
                                                        name="ticket_no" placeholder="ticket no" readonly
                                                        value="{{ $data->ticket_no }}">
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-lastname-input" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="basicpill-lastname-input"
                                                        placeholder="Customer Name" readonly
                                                        value="{{ $data->customer->first_name }}  {{ $data->customer->last_name }}">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-phoneno-input" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="basicpill-phoneno-input"
                                                        placeholder="Enter Phone Number" readonly
                                                        value="{{ $data->customer->phone_number }}">
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-email-input" class="form-label">Subject</label>
                                                    <input type="email" class="form-control" id="basicpill-email-input"
                                                        placeholder="Enter E-mail" value="{{ $data->subject }}" readonly>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-phoneno-input" class="form-label">Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="open"
                                                            {{ $data->status == 'open' ? 'selected' : '' }}>
                                                            Open</option>
                                                        <option value="close"
                                                            {{ $data->status == 'close' ? 'selected' : '' }}>
                                                            Close</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-email-input" class="form-label">Type</label>
                                                    <input type="email" class="form-control" id="basicpill-email-input"
                                                        placeholder="Enter E-mail" value="{{ $data->type }}" readonly>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->

                                        <div class="w-100 user-chat mt-sm-0">
                                            <div class="card">
                                                <div class="p-3 border-bottom">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-7">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="font-size-15 mb-1 text-truncate"><a
                                                                            href="#"
                                                                            class="text-dark">{{ $data->customer->first_name }}
                                                                            {{ $data->customer->last_name }}</a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="chat-conversation p-3" data-simplebar="init">
                                                        <div class="simplebar-wrapper" style="margin: -16px;">
                                                            <div class="simplebar-height-auto-observer-wrapper">
                                                                <div class="simplebar-height-auto-observer"></div>
                                                            </div>
                                                            <div class="simplebar-mask">
                                                                <div class="simplebar-offset"
                                                                    style="right: -17px; bottom: 0px;">
                                                                    <div class="simplebar-content-wrapper"
                                                                        style="height: 100%; overflow: hidden scroll;">
                                                                        <div class="simplebar-content"
                                                                            style="padding: 16px;">
                                                                            <ul class="list-unstyled mb-0">
                                                                                @foreach ($conversation as $item)
                                                                                    @if ($item->reply == 'customer')
                                                                                        <li>
                                                                                        @else
                                                                                        <li class="right">
                                                                                    @endif
                                                                                    <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="ctext-wrap-content">
                                                                                                <p class="mb-0">
                                                                                                    {{ $item->message }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div>
                                                                                            <h5 class="conversation-name">
                                                                                                <span
                                                                                                    class="">{{ $item->date }}</span>
                                                                                            </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    </li>
                                                                                    <!-- end li -->
                                                                                @endforeach
                                                                                {{-- <li>
                                                                                    <div class="conversation-list">
                                                                                        <div class="ctext-wrap">
                                                                                            <div class="ctext-wrap-content">
                                                                                                <p class="mb-0">Marie N!
                                                                                                    <br> Feels like it's
                                                                                                    been a while! Home
                                                                                                    are you? Do you have ant
                                                                                                    time
                                                                                                    for the remainder of the
                                                                                                    week to help me with an
                                                                                                    ongoing
                                                                                                    project?
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div>
                                                                                            <h5 class="conversation-name">
                                                                                                <span
                                                                                                    class="">10:00</span>
                                                                                            </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </li> --}}
                                                                                <!-- end li -->
                                                                            </ul>
                                                                            <!-- end ul -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="simplebar-placeholder"
                                                                style="width: auto; height: 1289px;"></div>
                                                        </div>
                                                        <div class="simplebar-track simplebar-horizontal"
                                                            style="visibility: hidden;">
                                                            <div class="simplebar-scrollbar"
                                                                style="transform: translate3d(0px, 0px, 0px); display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="simplebar-track simplebar-vertical"
                                                            style="visibility: visible;">
                                                            <div class="simplebar-scrollbar"
                                                                style="height: 25px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-3 chat-input-section">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control chat-input" name="message"
                                                                    placeholder="Enter Message...">

                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit"
                                                                class="btn btn-primary chat-send w-md"><span
                                                                    class="d-none d-sm-inline-block me-2">Send</span> <i
                                                                    class="mdi mdi-send float-end"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- wizard-tab -->

                                {{-- <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="submit" class="btn btn-primary w-sm ms-auto"
                                        id="nextBtn">Next</button>
                                </div> --}}
                            </form><!-- end form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
