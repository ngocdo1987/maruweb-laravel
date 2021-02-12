<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // https://github.com/laravel/framework/blob/6.x/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php
    use AuthenticatesUsers, CaptchaTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        return back()->withErrors(['email' => __('auth.failed')])->withInput($request->only('email', 'remember'));
    }

    protected function validateLogin(Request $request)
    {
        $request->merge([
            'captcha' => $this->captchaCheck($request)
        ]);

        $allRules = [
            $this->username() => 'required|string|email',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required',
            'captcha' => 'required|between:1,1'
        ];

        $this->validate($request, $allRules, [
            $this->username().'.required' => trans('validation.required'),
            $this->username().'.email' => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'g-recaptcha-response.required' => trans('validation.captcha'),
            'captcha.required' => trans('validation.captcha'),
            'captcha.between' => trans('validation.captcha')
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/'.config('auth.admin_dir').'/login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}
