<?php

namespace App\Http\Requests\CommonSetting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommonSettingRequest extends FormRequest
{
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
        $rules = [
            'image_width' => 'required|numeric',
            'image_height' => 'required|numeric',
            //'admin_email' => 'nullable|email'
        ];

        return $rules;
    }
}
