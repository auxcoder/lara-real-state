<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VisitorSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $nationalities = config('visitor.nationalities', []);
        $budgetRanges = config('visitor.budget_ranges', []);

        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[+0-9\s()\-]{7,20}$/'],
            'nationality' => ['required', 'string', 'max:255', Rule::in($nationalities)],
            'property_type' => ['nullable', 'string', 'max:100'],
            'specifications' => ['nullable', 'string', 'max:1000'],
            'preferred_location' => ['nullable', 'string', 'max:255'],
            'budget_range' => ['nullable', 'string', Rule::in(array_keys($budgetRanges))],
            'payment_for_rent' => ['required', 'in:Personal,Company'],
            'number_of_family_members' => ['nullable', 'integer', 'min:0', 'max:50'],
            'passport' => ['required', 'file', 'mimes:pdf', 'max:102400'],
            'emirates_id' => ['required', 'file', 'mimes:pdf', 'max:102400'],
            'bank_statement' => ['required', 'file', 'mimes:pdf', 'max:102400'],
            'trade_license' => ['nullable', 'file', 'mimes:pdf', 'max:102400'],
            'vat_registration_certificate' => ['nullable', 'file', 'mimes:pdf', 'max:102400'],
            'etihad_credit_bureau' => ['nullable', 'file', 'mimes:pdf', 'max:102400'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => __('validation.alpha_spaces'),
            'email.email' => __('email.invalid'),
            'phone_number.regex' => __('phone.invalid'),
        ];
    }
}
