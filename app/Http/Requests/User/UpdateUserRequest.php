<?php

namespace App\Http\Requests\User;

use App\Rules\Email;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\KatakanaFullWidth;
use App\Rules\NumberAndHyphen;
use App\Rules\ComplexPassword;
use App\Rules\PostalCode;

class UpdateUserRequest extends FormRequest
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
        // Normally, when admin edit user
        if (isset(request()->user_type) && in_array(request()->user_type, [0, 1, 2, 3])) {
            $rules0and1 = [
                'corporation_name' => 'required',
                'corporation_name_kana' => ['required', new KatakanaFullWidth],
                'head_office_postcode' => ['required', new PostalCode],
                'head_office_prefecture' => 'required',
                'head_office_city' => 'required',
                'head_office_address' => 'nullable',
                'association_notification_representative_fname' => 'required',
                'association_notification_representative_lname' => 'required',
                'association_notification_representative_fname_kana' => ['required', new KatakanaFullWidth],
                'association_notification_representative_lname_kana' => ['required', new KatakanaFullWidth],
                'association_notification_representative_2nd_fname_kana' => ['nullable', new KatakanaFullWidth],
                'association_notification_representative_2nd_lname_kana' => ['nullable', new KatakanaFullWidth],
                'department' => 'nullable',
                'representative_email' => ['required', new Email, 'unique:users,email,'.$this->id], 
                'representative_email_2nd' => ['nullable', new Email],
                'mailing_postcode' => ['required', new PostalCode],
                'mailing_prefecture' => 'required',
                'mailing_city' => 'required',
                'mailing_address' => 'nullable',
                'receive_name' => 'required',
                'contact_fname' => 'required',
                'contact_lname' => 'required',
                'contact_fname_kana' => ['required', new KatakanaFullWidth],
                'contact_lname_kana' => ['required', new KatakanaFullWidth],
                'contact_department' => 'nullable',
                'contact_email' => ['required', new Email],
                'tel' => ['required', new NumberAndHyphen],
                'fax' => ['nullable', new NumberAndHyphen],
                'corporate_url' => 'nullable|url',
                'industry' => 'required',
                'password' => ['nullable', new ComplexPassword]
            ];
    
            for ($i = 1; $i <= 10; $i++) {
                $rules0and1['delivery_address_'.$i] = ['nullable', new Email];
            }

        $rules0and2 = [
            'corporation_name' => 'nullable',
            'corporation_name_kana' => ['nullable', new KatakanaFullWidth],
            'head_office_postcode' => ['nullable', new PostalCode],
            'head_office_prefecture' => 'nullable',
            'head_office_city' => 'nullable',
            'head_office_address' => 'nullable',
            'association_notification_representative_fname' => 'required',
            'association_notification_representative_lname' => 'required',
            'association_notification_representative_fname_kana' => ['nullable', new KatakanaFullWidth],
            'association_notification_representative_lname_kana' => ['nullable', new KatakanaFullWidth],
            'association_notification_representative_2nd_fname_kana' => ['nullable', new KatakanaFullWidth],
            'association_notification_representative_2nd_lname_kana' => ['nullable', new KatakanaFullWidth],
            'department' => 'nullable',
            'representative_email' => ['required', new Email, 'unique:users,email,'.$this->id], 
            'representative_email_2nd' => ['nullable', new Email],
            'mailing_postcode' => ['nullable', new PostalCode],
            'mailing_prefecture' => 'nullable',
            'mailing_city' => 'nullable',
            'mailing_address' => 'nullable',
            'receive_name' => 'nullable',
            'contact_fname' => 'nullable',
            'contact_lname' => 'nullable',
            'contact_fname_kana' => ['nullable', new KatakanaFullWidth],
            'contact_lname_kana' => ['nullable', new KatakanaFullWidth],
            'contact_department' => 'nullable',
            'contact_email' => ['required', new Email],
            'tel' => ['nullable', new NumberAndHyphen],
            'fax' => ['nullable', new NumberAndHyphen],
            'corporate_url' => 'nullable|url',
            'industry' => 'nullable'
        ];

        for ($i = 1; $i <= 10; $i++) {
            $rules0and2['delivery_address_'.$i] = ['nullable', new Email];
        }
    
            switch (request()->user_type) {
                case 0:
                    // rules for user_type 0
                    return $rules0and2;
                    break;
                case 1:
                    // rules for user_type 1
                    $rules0and1['number_of_applications'] = 'required';
                    return $rules0and1;
                    break;
                case 2:
                    // rules for user_type 2
                    $rules2 = [
                        'fname' => 'required',
                        'lname' => 'required',
                        'fname_kana' => ['required', new KatakanaFullWidth],
                        'lname_kana' => ['required', new KatakanaFullWidth],
                        'home_postcode' => ['required', new PostalCode],
                        'home_prefecture' => 'required',
                        'home_city' => 'required',
                        'home_address' => 'nullable',
                        'gender' => 'required',
                        'birthday' => 'required',
                        'email' => ['required', new Email],
                        'tel' => ['required', new NumberAndHyphen],
                        'fax' => ['nullable', new NumberAndHyphen],
                        'choose_mailing_address' => 'required',
                        'industry' => 'required',
                        'company_name_kana' => ['nullable', new KatakanaFullWidth],
                        'company_postcode' => ['nullable', new PostalCode],
                        'company_email' => ['nullable', new Email],
                        'company_tel' => ['nullable', new NumberAndHyphen],
                        'company_fax' => ['nullable', new NumberAndHyphen],
                        'password' => ['nullable', new ComplexPassword]
                    ];

                    // company_name, company_name_kana, department, company_postcode, company_prefecture, company_city, company_address  (*), 
                    // company_email (*), company_tel, company_fax (*)
                    if (request()->choose_mailing_address == 1) {
                        $rules2['company_name'] = 'required';
                        $rules2['company_name_kana'] = ['required', new KatakanaFullWidth];
                        $rules2['department'] = 'required';
                        $rules2['company_postcode'] = ['required', new PostalCode];
                        $rules2['company_prefecture'] = 'required';
                        $rules2['company_city'] = 'required';
                        $rules2['company_tel'] = ['required', new NumberAndHyphen];
                    }
    
                    for ($i = 1; $i <= 10; $i++) {
                        $rules2['delivery_address_'.$i] = ['nullable', new Email];
                    }
    
                    return $rules2;
                    break;
                case 3:
                    // rules for user_type 3
                    return $rules0and2;
                    break;
                default:
                    return [];
                    break;
            }
        }
        
        // When admin change user status
        if (isset(request()->action) && request()->action == 'update-status') {
            return [
                'password' => ['nullable', new ComplexPassword]
            ];
        }
    }

    public function messages()
    {
        return [
            'representative_email.unique' => 'このメールアドレスは既に登録されています。',
        ];
    }
}
