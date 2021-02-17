<?php

namespace App\Http\Requests\UploadImage;

use Illuminate\Foundation\Http\FormRequest;
class StoreImageRequest extends FormRequest
{
    protected $service;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
        ];
    }

    // Process data
    public function storeImage()
    {
        
    }
}
