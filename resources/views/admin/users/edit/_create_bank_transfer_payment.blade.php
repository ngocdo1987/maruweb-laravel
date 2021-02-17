@if ($user->user_type != 2)
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">{{ __('Create bank transfer payment') }}</label>
        <label for="" class="col-sm-9 control-label" style="text-align: left;">
            <button type="button" class="btn btn-xs waves-effect waves-light btn-create-bank-transfer-payment" data-id="{{ $user->id }}" data-user-code="USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}">
                <span>{{ __('Create bank transfer payment') }}</span>
            </button>
        </label>
    </div>
@endif