<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                'assigned_to' =>  'required',
                'bank_name' => 'required',
                'bank_address' => 'required',
                'bank_branch' => 'required',
                'bank_code' => 'required',
                'swiftcode' => 'required',
                'bank_account_no' => 'required',
                'payment_date' => 'required',
                'payment_mode' => 'required',
                'currency' => 'required',
                'co_name_1' => 'required',
                'co_contact_name_1' => 'required',
                'co_address_1' => 'required',
                'co_city_1' => 'required',
                'co_postcode_1' => 'required',
                'co_phone_1' => 'required',
                'co_email_1' => 'required',
                'co_comment_1' => 'required',
                'co_name_2' => 'sometimes',
                'co_contact_name_2' => 'sometimes',
                'co_address_2' => 'sometimes',
                'co_city_2' => 'sometimes',
                'co_postcode_2' => 'sometimes',
                'co_phone_2' => 'sometimes',
                'co_email_2' => 'sometimes',
                'co_comment_2' => 'sometimes',
//                'terms' => 'required',
                'pin_cert' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'vat_cert' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'co_reg_cert' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'rep_id_file' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'directors_list' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'utility_bill' => 'nullable|mimes:pdf,doc,docx,zip,docm,xls,xlsx,xlsm',
                'total_turnover_1' => 'required',
                'total_assets_1' => 'required',
                'current_assets_1' => 'required',
                'total_liabilities_1' => 'required',
                'current_liabilities_1' => 'required',
                'profit_before_taxes_1' => 'required',
                'profit_after_taxes_1' => 'required',
                'total_turnover_2' => 'sometimes',
                'total_assets_2' => 'sometimes',
                'current_assets_2' => 'sometimes',
                'total_liabilities_2' => 'sometimes',
                'current_liabilities_2' => 'sometimes',
                'profit_before_taxes_2' => 'sometimes',
                'profit_after_taxes_2' => 'sometimes',
        ];
    }
}
