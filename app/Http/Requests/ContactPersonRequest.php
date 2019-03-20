<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactPersonRequest extends FormRequest
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
            'company_id' => 'required',
            'name'  => 'required',
            'title'  => 'required',
            'job_title'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'address_1' => 'required',
            'primary_contact' => 'required',
            'city' => 'required',
            'country' => 'required',
        ];

        return $rules;
    }
}
