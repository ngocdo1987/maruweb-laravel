<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonSettingService;
use Intervention\Image\Facades\Image ;
use File;

class UploadImageService extends AbstractEloquentService
{
    public $setting;

    public function __construct(CommonSettingService $setting)
    {
        $this->setting = $setting;
    }

    public function storeImage($request)
    {
        $data = $request->all();
        if ($data['image_path']) {
            $setting = $this->setting->searchAdvanced();
            
            $height = isset($setting['image_height']['value']) ?  $setting['image_height']['value'] : 200;
            $width = isset($setting['image_width']['value']) ? $setting['image_width']['value'] : 200;
            $result = uploadFileImage($data['image_path'], 'images/'.$data['type'], [], true, $width, $height, []);
            
            return $result;
        }

        return false;
    }
}
