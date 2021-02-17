@extends('layouts.admin.app_login')

@section('content')
<form method="POST" action="{{ route('admin.password.update') }}" class="frm-single">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="inside">
        <div class="title">{{ __('Reset Password') }}</div>

        <div class="frm-input">
            <input id="email" type="email" placeholder="{{ __('Email Address') }}" class="frm-inp" name="email" value="{{ $email ?? old('email') }}">
            <i class="fa fa-user frm-ico"></i>

            @error('email')
                <font color="red">{{ $message }}</font>
            @enderror
        </div>

        <div class="frm-input">
            <input id="password" type="password" placeholder="{{ __('Password') }}" class="frm-inp" name="password">
            <i class="fa fa-lock frm-ico"></i>

            @error('password')
                <font color="red">{{ $message }}</font>
            @enderror
        </div>

        <div class="frm-input">
            <input id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" class="frm-inp" name="password_confirmation">
            <i class="fa fa-lock frm-ico"></i>

            @error('password_confirmation')
                <font color="red">{{ $message }}</font>
            @enderror
        </div>

        <button type="submit" class="frm-submit">{{ __('Reset Password') }}<i class="fa fa-arrow-circle-right"></i></button>
        
        <div class="frm-footer">{{ config('app.name') }} © {{ date('Y') }}.</div>
    </div>
</form>
@endsection
