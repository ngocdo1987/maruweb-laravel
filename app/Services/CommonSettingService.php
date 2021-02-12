<?php
namespace App\Services;

use App\Models\CommonSetting;
use Illuminate\Support\Facades\DB;

class CommonSettingService extends AbstractEloquentService
{
    public function __construct(CommonSetting $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced()
    {
        $allSettings = CommonSetting::all();

        $commonSettings = [];

        foreach ($allSettings as $allSetting) {
            $commonSettings[$allSetting->setting_name] = [
                'human_name' => $allSetting->setting_human_name,
                'value' => $allSetting->setting_value
            ];
        }

        return $commonSettings;
    }

    // Store new common setting
    public function storeCommonSetting($request)
    {
        $data = $request->except('_token');

        foreach ($data as $k => $v) {
            CommonSetting::where('setting_name', $k)
                        ->update(['setting_value' => $v]);
        }
    }

    // Update existing common setting
    public function updateCommonSetting($request)
    {
        $data = $request->all();

        $commonSetting = CommonSetting::findOrFail($data['id']);
        $commonSetting->update($data);

        return $commonSetting->id;
    }

    // Get all test emails
    public static function getTestEmails()
    {
        $testEmails = CommonSetting::where('setting_name', 'test_emails')->first();
        if (isset($testEmails->setting_value)) {
            $testEmails = explode("\n", $testEmails->setting_value);

            for ($i = 0; $i < count($testEmails); $i++) {
                $testEmails[$i] = trim($testEmails[$i]);
            }
        }

        return $testEmails;
    }

    // Get datetime when send email at Sep 1st
    public static function get1stSep()
    {
        $timeConfig = config('constants.general.send_emails_at_1st_september');
        $timeConfig = str_replace('yyyy', date('Y'), $timeConfig);
        $timeConfig = $timeConfig.' 00:01:00';

        if (config('app.env') == 'production') {
            return $timeConfig;
        } else {
            $commonSetting = CommonSetting::where('setting_name', 'send_emails_at_1st_september')->first();

            if (isset($commonSetting->setting_value)) {
                return $commonSetting->setting_value;
            } else {
                return $timeConfig;
            }
        }
    }

    // Get datetime when send mail at Oct 15th
    public static function get15thOct()
    {
        $timeConfig = config('constants.general.send_emails_at_15th_october');
        $timeConfig = str_replace('yyyy', date('Y'), $timeConfig);
        $timeConfig = $timeConfig.' 00:01:00';

        if (config('app.env') == 'production') {
            return $timeConfig;
        } else {
            $commonSetting = CommonSetting::where('setting_name', 'send_emails_at_15th_october')->first();

            if (isset($commonSetting->setting_value)) {
                return $commonSetting->setting_value;
            } else {
                return $timeConfig;
            }
        }
    }
}
