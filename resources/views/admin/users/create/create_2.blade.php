<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Full name') }} <font color="red">※</font></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}">
        @error('fname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}">
        @error('lname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Full name (kana)') }} <font color="red">※</font></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="fname_kana" name="fname_kana" value="{{ old('fname_kana') }}">
        @error('fname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="lname_kana" name="lname_kana" value="{{ old('lname_kana') }}">
        @error('lname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Home -->
@include('admin.users.create._address-person', [
    'name' => 'home',
    'prefectureConfig' => $prefectureConfig
])

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Gender') }} <font color="red">※</font></label>
    <label for="" class="col-sm-9 control-label" style="text-align: left;">
        @foreach ($genderConfig as $k => $v)
            @php 
                $checked = $k == old('gender') ? ' checked="checked"' : ''
            @endphp
            <input type="radio" name="gender" id="gender_{{ $k }}" value="{{ $k }}"{{ $checked }} /> 
            <label for="gender_{{ $k }}">{{ __($v) }}</label> &nbsp; &nbsp;
        @endforeach

        @error('gender')
            <font color="red">{{ $message }}</font>
        @enderror
    </label>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Birthday') }} <font color="red">※</font></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="birthday" name="birthday" value="{{ old('birthday') }}" autocomplete="off">
        @error('birthday')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('Email Address') }} <span style="color: red"> (ログインID)</span> <font color="red">※</font> 
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
        @error('email')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('TEL') }} <font color="red">※</font></label>
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

<!-- Company -->
<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('Company name') }} 
        <font color="red" class="font_company" style="display: none;">※</font>
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}">
        @error('company_name')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('Company name (kana)') }} 
        <font color="red" class="font_company" style="display: none;">※</font>
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_name_kana" name="company_name_kana" value="{{ old('company_name_kana') }}">
        @error('company_name_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('Department') }} 
        <font color="red" class="font_company" style="display: none;">※</font>
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
        @error('department')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Company -->
@include('admin.users.create._address', [
    'name' => 'company',
    'prefectureConfig' => $prefectureConfig
])

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Email Address') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_email" name="company_email" value="{{ old('company_email') }}">
        @error('company_email')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        {{ __('TEL') }} 
        <font color="red" class="font_company" style="display: none;">※</font>
    </label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_tel" name="company_tel" value="{{ old('company_tel') }}">
        @error('company_tel')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('FAX') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_fax" name="company_fax" value="{{ old('company_fax') }}">
        @error('company_fax')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Choose mailing address') }} <font color="red">※</font></label>
    <label for="" class="col-sm-9 control-label" style="text-align: left;">
        @foreach ($chooseMailingAddressConfig as $k => $v)
            @php 
                $checked = $k == old('choose_mailing_address') ? ' checked="checked"' : ''
            @endphp
            <input type="radio" name="choose_mailing_address" id="choose_mailing_address_{{ $k }}" value="{{ $k }}"{{ $checked }} /> 
            <label for="choose_mailing_address_{{ $k }}">{{ __($v) }}</label> &nbsp; &nbsp;
        @endforeach

        @error('choose_mailing_address')
            <font color="red">{{ $message }}</font>
        @enderror
    </label>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Industry') }} <font color="red">※</font></label>
    <div class="col-sm-9">
        <select name="industry" id="industry" class="form-control">
            @foreach ($industryConfig as $k => $v)
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