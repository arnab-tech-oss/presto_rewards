<div class= "card card_content mb-0">
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="type" class="required">Tittle</label>
            <input type="text"   class="form-control" name="title"
                value="{{ $view_offer->title }}" readonly>
        </div>
     </div>

<div class="col-sm-4">
    <div class="form-group">
        <label for="role_id" class="required">Start Date</label>
        <input type="datetime-local" name="start_date" class="form-control" placeholder="stat Date" value="{{$view_offer->start_date}}" readonly>
    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <label for="role_id" class="required">End Date</label>
        <input type="datetime-local" name="end_date" class="form-control" placeholder="Enter Date" value="{{$view_offer->end_date}}" readonly>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label class="optional">Description</label>
        <input type="text" class="form-control" name="description" value="{{$view_offer->description}}" readonly>
        <input type="hidden" name="id" value="{{$view_offer->id}}">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label class="">Cta_Type</label>
        <input type="text" class="form-control" name="cta_type" value="{{$view_offer->cta_type}}" readonly>
        <input type="hidden" name="id" value="{{$view_offer->id}}">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label class="">Action_link</label>
        <input type="text" class="form-control" name="action_link" value="{{$view_offer->action_link}}" readonly>
        <input type="hidden" name="id" value="{{$view_offer->id}}">
    </div>
</div>

</div>

    <div class="col-sm-12">
        <div class="form-group">
            <label class="optional">Banner</label>
            <br>
            <img src="{{ asset($view_offer->baner)}}" alt="Company Logo" class="img-fluid" style="width: 200px;">
        </div>
    </div>

</div>
