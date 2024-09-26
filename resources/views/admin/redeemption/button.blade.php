<div class ="btn-group">
    @if ($item->status == 'pending')
        <a href="{{ route('request.approved', $item->id) }}" class="edit btn text-white bg-success btn-sm">Approve</a>
        <button class="btn btn-danger btn-sm" id="openModalButton" data-item-id="{{ $item->id }}">Reject</button>
    @endif
</div>
<script>
    $(document).ready(function() {
        $('#openModalButton').click(function() {
            var itemId = $(this).data('item-id');
            $('#reject').modal('show');
            //$('#openModalButton').disable(true);
            $(this).prop('disabled', true);
            $('#submitreject').attr('data-item-id', itemId);

        });

        $('#submitreject').click(function() {
            var itemId = $(this).data('item-id');
            if ($('#rejectionReason').val() != '') {
                $('#submitreject').prop('disabled', true);
                submitRejection(itemId);
                $('#reject').modal('hide');
                //$('#resonerror').html('');
            } else {
                $('#resonerror').html('please enter proper reason');
            }

        });
    });

    var isSubmitting = false;

    function submitRejection(itemId) {

        if (isSubmitting) {
            return;
        }

        var itemId = itemId;
        var rejectionReason = $('#rejectionReason').val();
        isSubmitting = true;

        $.ajax({
            url: "{{ route('request.rejected') }}", // Change this URL to the appropriate route for submission
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                itemId: itemId,
                rejectionReason: rejectionReason
            },
            success: function(data) {
                //$('#reject').modal('hide');
                toastr.error(data.messagee); // Display a success message (adjust as needed)
                //$('#reject').modal('hide'); // Close the modal
                $('.datatable').DataTable().ajax.reload();
                window.location.reload();
            },
            error: function(error) {
                alert('Error occurred while submitting rejection.'); // Handle errors
            },
            complete: function() {
                // Reset the flag after the request is complete
                isSubmitting = false;
            }
        });
    }
</script>
