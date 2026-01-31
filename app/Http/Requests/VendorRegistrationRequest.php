<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:information,email',
            'phone_number' => 'required|string|max:20',
            'trade_license' => 'required|image|mimes:jpg,png|max:10240',
            'emirates_id' => 'required|image|mimes:jpg,png|max:10240',
            'passport' => 'required|image|mimes:jpg,png|max:10240',
            'bank_account_no' => 'required|numeric',
            'iban_letter' => 'required|string|max:255',
            'vat_registration_no' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'office_address' => 'required|string|max:500',
        ];
    }
}
