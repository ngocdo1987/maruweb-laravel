@extends('layouts.admin.app_login')

@section('content')
<form method="POST" action="{{ route('admin.login') }}" class="frm-single">
    @csrf

    <div class="inside">
        <div class="title">{{ __('Login') }}</div>
        <!-- /.title -->

        <div class="frm-input">
            <input id="email" type="email" placeholder="{{ __('Email Address') }}" class="frm-inp" name="email" value="{{ old('email') }}">
            <i class="fa fa-user frm-ico"></i>

            @error('email')
                <div class="alert alert-danger txt-small" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- /.frm-input -->

        <div class="frm-input">
            <input id="password" type="password" placeholder="{{ __('Password') }}" class="frm-inp" name="password">
            <i class="fa fa-lock frm-ico"></i>

            @error('password')
                <div class="alert alert-danger txt-small" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <!-- /.frm-input -->

        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        @error('g-recaptcha-response')
            <div class="alert alert-danger txt-small" role="alert">
                {{ $message }}
            </div>
        @enderror
        @error('captcha')
            <div class="alert alert-danger txt-small" role="alert">
                {{ $message }}
            </div>
        @enderror

        <div class="clearfix margin-bottom-20">
            <div class="pull-left">
                <div class="checkbox primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>
                <!-- /.checkbox -->
            </div>
            <!-- /.pull-left -->
            
        </div>
        <!-- /.clearfix -->

        <p><a href="{{ route('admin.password.request') }}">パスワードをお忘れの方はこちら</a></p>
        <button type="submit" class="frm-submit">{{ __('Login') }}<i class="fa fa-arrow-circle-right"></i></button>
        
        <div class="frm-footer">{{ config('app.name') }} © {{ date('Y') }}.</div>
        <!-- /.footer -->
    </div>
    <!-- .inside -->
</form>
<!-- /.frm-single -->
@endsection
