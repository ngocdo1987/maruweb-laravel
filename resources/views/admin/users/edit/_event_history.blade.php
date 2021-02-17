<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        <h4>{{ __('Event participation history') }}</h4>
    </label>
    <div class="col-sm-9">
        @foreach ($eventTypeConfig as $k => $v)
            【{{ __($v) }}】<br/>

            @foreach ($events as $event)
                @if ($event->event_type == $k)
                    <div class="row" id="row_delete_event_{{ $event->id }}">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" value="{{ $event->joined_date }}" disabled />
                        </div>
                        <div class="col-sm-9">
                            <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btn-delete-event" data-id="{{ $event->id }}">
                                <i class="ico fa fa-trash"></i> {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="row" id="row_add_event_{{ $k }}">
                <div class="col-sm-3">
                <input type="text" class="form-control add-event-joined-date" name="add_event_joined_date_{{ $k }}" id="add_event_joined_date_{{ $k }}" value="{{ old('add_event_joined_date_'.$k) }}" />
                </div>
                <div class="col-sm-9">
                    <button type="button" class="btn btn-xs btn-primary waves-effect waves-light btn-add-event-joined-date" data-id="{{ $k }}">
                        <i class="fa fa-plus-circle"></i> {{ __('Add') }}
                    </button>
                </div>
            </div>
            <br/>
        @endforeach
    </div>
</div>