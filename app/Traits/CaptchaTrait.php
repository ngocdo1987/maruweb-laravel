<?php
namespace App\Traits;

use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;

trait CaptchaTrait
{
    public function captchaCheck(Request $request)
    {
        $allRequest = $request->all();
        $response = isset($allRequest['g-recaptcha-response']) ? $allRequest['g-recaptcha-response'] : '';
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RECAPTCHA_SECRET_KEY');

        $reCaptcha = new ReCaptcha($secret);
        $resp = $reCaptcha->verify($response, $remoteIp);
        if ($resp->isSuccess()) {
            return 1;
        } else {
            return 0;
        }
    }
}
