<div class= "card card_content mb-0">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Customer Name</label>
                <input type="text" class="form-control"
                    value="{{ strtoupper($data->customer->first_name) . ' ' . strtoupper($data->customer->last_name) }}"
                    readonly>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="role_id">Phone No</label>
                <input type="text" class="form-control" placeholder="Enter your Btrand name"
                    value="{{ $data->customer->phone_number }}" readonly>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <label>Reference No</label>
                <input required="" type="text" class="form-control" value="{{ $data->transaction->ref_no }}"
                    readonly>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group">
                <label>Bank Reference No</label>
                <input required="" type="text" class="form-control" value="{{ $data->transaction->bank_ref }}"
                    readonly>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" value="{{ $data->transaction->amount }}" readonly>
            </div>
        </div>

    
        <div class="col-sm-4">
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" value="{{ $data->transaction->status }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">payment type</label>
                <input type="text" class="form-control"  value="{{ $data->payment_type }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Transaction No</label>
                <input type="text" class="form-control" value="{{ $data->transaction->bankrrn }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Message</label>
                <input type="text" class="form-control" value="{{ $data->transaction->message }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Bank RRN</label>
                <input type="text" class="form-control" value="{{ $data->transaction->bankrrn }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">UPI Tranlong Id</label>
                <input type="text" class="form-control" value="{{ $data->transaction->upitranlog_id }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Sequence No</label>
                <input type="text" class="form-control" value="{{ $data->transaction->seq_no }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Mobile App Data</label>
                <input type="text" class="form-control" value="{{ $data->transaction->mobileappdata }}" readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="optional">Response Code</label>
                <input type="text" class="form-control" value="{{ $data->transaction->response_code }}" readonly>
            </div>
        </div>

    </div>
</div>
