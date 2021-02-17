<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        ※{{ __('Change password') }}
    </label>
    <div class="col-sm-3">
        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
        @error('password')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    
    <div class="col-sm-6">
        <!-- Unsubscribe user -->
        @if ($user->status == 0 || $user->status == 1)
            <button type="button" class="btn btn-xs btn-danger btn-leave" id="btn-leave-{{ $user->id }}" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                <i class="ico fa fa-trash"></i> <span>{{ __('Leave') }}</span>
            </button>
        @else 
            <button type="button" class="btn btn-xs btn-danger btn-leave" id="btn-leave-{{ $user->id }}" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                <i class="ico fa fa-trash"></i> <span>{{ __('Unsubscribed') }}</span>
            </button>
        @endif

        <!-- Enable / Disable user -->
        @if ($user->status == 0 || $user->status == 2)
            <button type="button" class="btn btn-xs btn-success btn-status" id="btn-status-{{ $user->id }}" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                <span>{{ __('On') }}</span>
            </button>
        @else 
            <button type="button" class="btn btn-xs btn-danger btn-status" id="btn-status-{{ $user->id }}" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                <span>{{ __('Off') }}</span>
            </button>
        @endif
    </div>
</div>