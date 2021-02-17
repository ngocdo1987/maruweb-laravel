<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Full name') }} <font color="red">※</font></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $user->fname) }}">
        @error('fname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $user->lname) }}">
        @error('lname')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Full name (kana)') }} <font color="red">※</font></label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="fname_kana" name="fname_kana" value="{{ old('fname_kana', $user->fname_kana) }}">
        @error('fname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
    <div class="col-sm-5">
        <input type="text" class="form-control" id="lname_kana" name="lname_kana" value="{{ old('lname_kana', $user->lname_kana) }}">
        @error('lname_kana')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Home -->
@include('admin.users.edit._address-person', [
    'name' => 'home',
    'prefectureConfig' => $prefectureConfig,
    'user' => $user
])

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Gender') }} <font color="red">※</font></label>
    <label for="" class="col-sm-9 control-label" style="text-align: left;">
        @foreach ($genderConfig as $k => $v)
            @php 
                $checked = $k == old('gender', $user->gender) ? ' checked="checked"' : ''
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
        <input type="text" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}">
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
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
        @error('email')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('TEL') }} <font color="red">※</font></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', $user->tel) }}">
        @error('tel')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('FAX') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $user->fax) }}">
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
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $user->company_name) }}">
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
        <input type="text" class="form-control" id="company_name_kana" name="company_name_kana" value="{{ old('company_name_kana', $user->company_name_kana) }}">
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
        <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $user->department) }}">
        @error('department')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

<!-- Company -->
@include('admin.users.edit._address-person', [
    'name' => 'company',
    'prefectureConfig' => $prefectureConfig,
    'user' => $user
])

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Email Address') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', $user->company_email) }}">
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
        <input type="text" class="form-control" id="company_tel" name="company_tel" value="{{ old('company_tel', $user->company_tel) }}">
        @error('company_tel')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('FAX') }}</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="company_fax" name="company_fax" value="{{ old('company_fax', $user->company_fax) }}">
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
                $checked = $k == old('choose_mailing_address', $user->choose_mailing_address) ? ' checked="checked"' : ''
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
                    $selected = $k == old('industry', $user->industry) ? ' selected' : ''
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
                    $selected = $i == old('refining_building_rating_year', $refiningBuildingRatingYear) ? ' selected' : ''
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
                    $selected = $i == old('refining_building_rating_month', $refiningBuildingRatingMonth) ? ' selected' : ''
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
                    $selected = $k == old('client', $user->client) ? ' selected' : ''
                @endphp
                <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>
            @endforeach
        </select>

        @error('client')
            <font color="red">{{ $message }}</font>
        @enderror
    </div>
</div>

@if (isset($payment->id))
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">{{ __('Payment method') }}</label>
        <label for="" class="col-sm-9 control-label" style="text-align: left;">
            
            {{ isset($paymentMethodConfig[$payment->payment_method]) ? __($paymentMethodConfig[$payment->payment_method]) : '' }}
            
            @if ($payment->payment_method == 1 && $payment->status == 0)
                <button type="button" class="btn btn-xs btn-success btn-payment" id="btn-payment-{{ $payment->id }}" data-id="{{ $payment->id }}">
                    <span>{{ __('Confirm payment') }}</span>
                </button>
            
                <button type="button" class="btn btn-xs btn-danger btn-cancel-payment" id="btn-cancel-payment-{{ $payment->id }}" data-id="{{ $payment->id }}">
                    <span>{{ __('Cancel confirmation') }}</span>
                </button>
            @endif
            
        </label>
    </div>
@endif

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Email magazine') }}</label>
    <label for="" class="col-sm-9 control-label" style="text-align: left;">
        @php 
            $checked = old('email_magazine', $user->email_magazine) == 1 ? ' checked' : '';
        @endphp
        <input type="checkbox" name="email_magazine" id="email_magazine" value="1"{{ $checked }} />
        
        @error('email_magazine')
            <font color="red">{{ $message }}</font>
        @enderror
    </label>
</div>

@for ($i = 1 ; $i <= 10; $i++)
    @php 
        $deliveryAddress = isset($emailDeliveryAddress['delivery_address_'.$i]) ? $emailDeliveryAddress['delivery_address_'.$i] : '';
    @endphp
    <div class="form-group">
        <label for="" class="col-sm-3 control-label">{{ __('Delivery address') }}{{ $i }}</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="delivery_address_{{ $i }}" name="delivery_address_{{ $i }}" value="{{ old('delivery_address_'.$i, $deliveryAddress) }}">
            
            @error('delivery_address_'.$i)
                <font color="red">{{ $message }}</font>
            @enderror
        </div>
    </div>
@endfor

<!-- Events -->
@include('admin.users.edit._event_history', [
    'events' => $events,
    'eventTypeConfig' => $eventTypeConfig
])

<!-- Payments -->
@include('admin.users.edit._payments', [
    'payments' => $user->payments,
    'paymentMethodConfig' => $paymentMethodConfig,
    'statusConfig' => $paymentStatusConfig,
    'user' => $user
])

<!-- Reply mails -->
@include('admin.users.edit._reply_mails', [
    'replyMails' => $replyMails
])

<!-- Change password -->
@include('admin.users.edit._change_password', [
    'user' => $user
])

<div class="form-group">
    <label for="" class="col-sm-3 control-label">{{ __('Admin note') }}</label>
    <div class="col-sm-9">
        <textarea class="form-control" name="admin_note" id="admin_note">{{ old('admin_note', $user->admin_note) }}</textarea>
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