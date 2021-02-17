<?php

namespace App\Http\Requests\Admin;

use App\Rules\Email;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ComplexPassword;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required','unique:admins,email,'.$this->id, new Email],
            'role' => 'required',
            //'password' => ['nullable', 'min:8', new ComplexPassword],
            //'confirm_password' => 'nullable|same:password'
        ];

        if (request()->password != '') {
            $rules['password'] = ['min:8', new ComplexPassword];
            $rules['confirm_password'] = 'same:password';
        }

        return $rules;
    }
}
