<?php

namespace App\Http\Requests\Admin;

use App\Rules\Email;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ComplexPassword;

class StoreAdminRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => ['required','unique:admins,email', new Email],
            'role' => 'required',
            'password' => ['required', 'min:8', new ComplexPassword],
            'confirm_password' => 'required|same:password'
        ];
    }
}
