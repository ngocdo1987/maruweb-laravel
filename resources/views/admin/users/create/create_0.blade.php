<div class="form-group">
    <label for="corporation_name" class="col-sm-3 control-label">{{ __('Corporation name') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="corporation_name" name="corporation_name" value="{{ old('corporation_name') }}">
        @error('corporation_name')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="corporation_name_kana" class="col-sm-3 control-label">{{ __('Corporation name (kana)') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="corporation_name_kana" name="corporation_name_kana" value="{{ old('corporation_name_kana') }}">
        @error('corporation_name_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Head office -->
@include('admin.users.create._address-2', [
    'name' => 'head_office',
    'prefectureConfig' => $prefectureConfig
])

<!-- representative -->
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Association notification representative name') }} <font color="red">※</font></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="association_notification_representative_fname" name="association_notification_representative_fname" value="{{ old('association_notification_representative_fname') }}">
        @error('association_notification_representative_fname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="association_notification_representative_lname" name="association_notification_representative_lname" value="{{ old('association_notification_representative_lname') }}">
        @error('association_notification_representative_lname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Association notification representative name (kana)') }}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="association_notification_representative_fname_kana" name="association_notification_representative_fname_kana" value="{{ old('association_notification_representative_fname_kana') }}">
        @error('association_notification_representative_fname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="association_notification_representative_lname_kana" name="association_notification_representative_lname_kana" value="{{ old('association_notification_representative_lname_kana') }}">
        @error('association_notification_representative_lname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Department') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
        @error('department')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('Representative email') }} <span style="color: red"> (ログインID)</span> <font color="red">※</font>
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="representative_email" name="representative_email" value="{{ old('representative_email') }}">
        @error('representative_email')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- representative 2nd -->
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Association notification representative name 2nd') }}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="association_notification_representative_2nd_fname" name="association_notification_representative_2nd_fname" value="{{ old('association_notification_representative_2nd_fname') }}">
        @error('association_notification_representative_2nd_fname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="association_notification_representative_2nd_lname" name="association_notification_representative_2nd_lname" value="{{ old('association_notification_representative_2nd_lname') }}">
        @error('association_notification_representative_2nd_lname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Association notification representative name 2nd (kana)') }}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="association_notification_representative_2nd_fname_kana" name="association_notification_representative_2nd_fname_kana" value="{{ old('association_notification_representative_2nd_fname_kana') }}">
        @error('association_notification_representative_2nd_fname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="association_notification_representative_2nd_lname_kana" name="association_notification_representative_2nd_lname_kana" value="{{ old('association_notification_representative_2nd_lname_kana') }}">
        @error('association_notification_representative_2nd_lname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Department 2nd') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="department_2nd" name="department_2nd" value="{{ old('department_2nd') }}">
        @error('department_2nd')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Representative email 2nd') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="representative_email_2nd" name="representative_email_2nd" value="{{ old('representative_email_2nd') }}">
        @error('representative_email_2nd')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Refining building rating') }}</label>
    <div class="col-sm-4">
        <select name="refining_building_rating_year" id="refining_building_rating_year" class="form-control">
            <option value="">--</option>
            @for ($i = 2020; $i >= 1900; $i--)
                @php
                    $selected = $i == old('refining_building_rating_year') ? ' selected' : ''
                @endphp
                <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
            @endfor
        </select>

        @error('refining_building_rating_year')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <select name="refining_building_rating_month" id="refining_building_rating_month" class="form-control">
            <option value="">--</option>
            @for ($i = 1; $i <= 12; $i++)
                @php
                    $selected = $i == old('refining_building_rating_month') ? ' selected' : ''
                @endphp
                <option value="{{ $i }}"{{ $selected }}>{{ $i }}</option>
            @endfor
        </select>

        @error('refining_building_rating_month')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Client') }}</label>
    <div class="col-sm-9">
        <select name="client" id="client" class="form-control">
            <option value="-1">--</option>
            @foreach ($clientConfig as $k => $v)
                @php
                    $selected = $k == old('client') ? ' selected' : ''
                @endphp
                <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>
            @endforeach
        </select>

        @error('client')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Mailing address -->
@include('admin.users.create._address-2', [
    'name' => 'mailing',
    'prefectureConfig' => $prefectureConfig
])

<!-- Contact -->
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Receive name') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="receive_name" name="receive_name" value="{{ old('receive_name') }}">
        @error('receive_name')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Contact name') }}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="contact_fname" name="contact_fname" value="{{ old('contact_fname') }}">
        @error('contact_fname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="contact_lname" name="contact_lname" value="{{ old('contact_lname') }}">
        @error('contact_lname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Contact name (kana)') }}</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="contact_fname_kana" name="contact_fname_kana" value="{{ old('contact_fname_kana') }}">
        @error('contact_fname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="contact_lname_kana" name="contact_lname_kana" value="{{ old('contact_lname_kana') }}">
        @error('contact_lname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Contact department') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="contact_department" name="contact_department" value="{{ old('contact_department') }}">
        @error('contact_department')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Contact email') }} <font color="red">※</font></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
        @error('contact_email')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('TEL') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel') }}">
        @error('tel')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('FAX') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax') }}">
        @error('fax')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Corporate URL') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="corporate_url" name="corporate_url" value="{{ old('corporate_url') }}">
        @error('corporate_url')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Industry') }}</label>
    <div class="col-sm-9">
        <select name="industry" id="industry" class="form-control">
            @foreach ($industryCoConfig as $k => $v)
                @php
                    $selected = $k == old('industry') ? ' selected' : ''
                @endphp
                <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>
            @endforeach
        </select>
        @error('industry')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

@yield('number_of_applications')

<input type="hidden" name="payment_method" value="0" />

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Email magazine') }}</label>
    <label for="" class="col-sm-9 control-label" style="text-align: left;">
        @php 
            $checked = old('email_magazine') == 1 ? ' checked' : '';
        @endphp
        <input type="checkbox" name="email_magazine" id="email_magazine" value="1"{{ $checked }} />
        
        @error('email_magazine')
            <font color="red">{{ $message }}</font>
        @enderror
    </label>
</div>

@for ($i = 1; $i <= 10; $i++)
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">{{ __('Delivery address') }}{{ $i }}</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="delivery_address_{{ $i }}" name="delivery_address_{{ $i }}" value="{{ old('delivery_address_'.$i) }}">
            
            @error('delivery_address_'.$i)
                <font color="red">{{ $message }}</font>
            @enderror
        </div>
    </div>
@endfor

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Admin note') }}</label>
    <div class="col-sm-9">
        <textarea class="form-control" name="admin_note" id="admin_note">{{ old('admin_note') }}</textarea>
        @error('admin_note')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group margin-bottom-0">
    <div class="col-sm-offset-3 col-sm-9">
        <a href="javascript:void(0)" id="go_back" class="btn btn-warning waves-effect waves-light">
            <i class="fa fa-chevron-circle-left"></i> {{ __('Return') }}
        </a>

        <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
            <i class="fa fa-save"></i> {{ __('Save') }}
        </button>
    </div>
</div>