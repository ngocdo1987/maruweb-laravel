<div class="row" id="row_delete_event_{{ $event->id }}">
    <div class="col-sm-3">
        <input type="text" class="form-control" value="{{ $event->joined_date }}" disabled />
    </div>
    <div class="col-sm-9">
        <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btn-delete-event" id="btn_delete_event_{{ $event->id }}" data-id="{{ $event->id }}">
            <i class="ico fa fa-trash"></i> {{ __('Delete') }}
        </button>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        // Delete event
        $('#btn_delete_event_{{ $event->id }}').on('click', function() {
            var eventId = $(this).attr('data-id');
            var ok = confirm("{{ __('Are you sure to delete ?') }}");

            if (ok == 1) {
                $.post("/{{ config('auth.admin_dir') }}/users/events/" + eventId, {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    '_method': 'DELETE' 
                }, function(data) {
                    data = data.trim();

                    if (data == eventId) {
                        $('#row_delete_event_' + eventId).remove();
                    }
                });
            } 
        });
    });
</script>