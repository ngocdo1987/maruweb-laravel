<?php

namespace App\Http\Controllers\Admin;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadImageService;
use App\Http\Requests\UploadImage\StoreImageRequest;

use Illuminate\Support\Facades\Log;
class UploadImageController extends Controller
{
    protected $service;

    public function __construct(UploadImageService $service)
    {
        $this->service  = $service;
    }

    public function store(StoreImageRequest $request)
    {
        setcookie('checkImg'.$request->all()['type'], 1, time() + (86400 * 2) , "/"); // 86400 = 1 day
        $data = $this->service->storeImage($request);
        if ($data['code']) {
            return ['status' => true, 'message'=> "",'data' =>$data ];
        }

        return ['status' => false, 'message'=> "",'data' =>$data];
    }

    public function destroy(Request $request)
    {
        if ($request->image_path) {
            deleteFileImage($request->image_path);
        }

        return ['status' => true,'message'=> ""];
    }
}
