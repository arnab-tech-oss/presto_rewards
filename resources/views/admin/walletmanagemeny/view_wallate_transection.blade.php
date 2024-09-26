<div class= "card card_content mb-0">
    <div class="row" >
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Customer Name</label>
                <input type="text" class="form-control" value="{{$data->wallet->customer->first_name}}" readonly>
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label for="role_id" >Customer Phone no</label>
                <input type="text" class="form-control" placeholder="Enter your Btrand name" value="{{$data->wallet->customer->phone_number}}" readonly>
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label>Transaction Type</label>
                <br>
                {{-- <input type="text" class="form-control" value="{{ $data->transactiontype }}" readonly> --}}
                @if ($data->transactiontype == 'cr') 
                     <span class='badge bg-success'>Credited</span>
                 @else 
                     <span class='badge bg-danger'>Debited</span>
                @endif
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label class="optional">Wallet ID</label>
                <input type="text" class="form-control" value="{{ $data->wallet_id}}" readonly>
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label class="optional">Transaction Date</label>
                <input type="text" class="form-control" value= "{{ $data->date }}" readonly>
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label class="optional">Transaction Amount</label>
                <input type="text" class="form-control" value="{{ $data->amount }}" readonly>
            </div>
        </div>
    
    </div>
    </div>