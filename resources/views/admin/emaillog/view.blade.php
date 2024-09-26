<div class="modal-body text-wrap overflow-auto w-100">
    <div class="d-flex flex-column">
        <label>From : {{$data->from}}</label>
        <label>To : {{$data->to}}</label>
        <label>CC : {{$data->cc}} </label>
        <label>BCC : {{$data->bcc}} </label>
        <label>Time: {{$data->date}}</label>
    </div>
    <h1>{{$data->body}}</h1>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        Close
    </button>
</div>


