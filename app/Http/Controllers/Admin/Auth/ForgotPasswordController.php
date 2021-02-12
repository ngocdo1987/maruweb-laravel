<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // https://github.com/laravel/framework/blob/6.x/src/Illuminate/Foundation/Auth/SendsPasswordResetEmails.php
    use SendsPasswordResetEmails, CaptchaTrait;

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    /*
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
    }
    */

    protected function validateEmail(Request $request)
    {
        $request->merge([
            'captcha' => $this->captchaCheck($request)
        ]);

        $allRules = [
            'email' => 'required|email',
            'g-recaptcha-response' => 'required',
            'captcha' => 'required|between:1,1'
        ];

        $this->validate($request, $allRules, [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'g-recaptcha-response.required' => trans('validation.captcha'),
            'captcha.required' => trans('validation.captcha'),
            'captcha.between' => trans('validation.captcha')
        ]);
    }
    
    public function broker()
    {
        return Password::broker('admins');
    }
}
