@php 
    $humanName = str_replace("_", " ", $name);
    $humanName = ucfirst($humanName);
@endphp

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __($humanName.' address') }}</label>
    <label for="" class="col-sm-1 control-label">
        {{ __('Postal code') }}
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="{{ $name }}_postcode" name="{{ $name }}_postcode" value="{{ old($name.'_postcode') }}">
        @error($name.'_postcode')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>

    <!--
    <div class="col-sm-2">
        <button type="button" class="btn btn-sm btn-primary">
            <span>{{ __('Enter address from zip code') }}</span>
        </button>
        
    </div>
    -->
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label"></label>
    <label for="" class="col-sm-1 control-label">
        {{ __('Prefecture') }}
    </label>
    <div class="col-sm-8">
        <select name="{{ $name }}_prefecture" id="{{ $name }}_prefecture" class="form-control">
            <option value="">--</option>
            @foreach ($prefectureConfig as $pC)
                @php
                    $selected = $pC == old($name.'_prefecture') ? ' selected' : ''
                @endphp
                <option value="{{ $pC }}"{{ $selected }}>{{ $pC }}</option>
            @endforeach
        </select>
        @error($name.'_prefecture')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label"></label>
    <label for="" class="col-sm-1 control-label">
        {{ __('City address') }}
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="{{ $name }}_city" name="{{ $name }}_city" value="{{ old($name.'_city') }}">
        @error($name.'_city')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label"></label>
    <label for="" class="col-sm-1 control-label">
        {{ __('Building name/room') }} 
    </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="{{ $name }}_address" name="{{ $name }}_address" value="{{ old($name.'_address') }}">
        @error($name.'_address')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>