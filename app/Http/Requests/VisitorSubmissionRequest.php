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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[+0-9\s()\-]{7,20}$/'],
            'nationality' => ['required', 'string', 'max:255', Rule::in($nationalities)],
            'property_type' => 'nullable|string',
            'specifications' => 'nullable|string',
            'preferred_location' => 'nullable|string',
            'budget_range' => ['nullable', 'string', Rule::in(array_keys($budgetRanges))],
            'payment_for_rent' => 'required|in:Personal,Company',
            'number_of_family_members' => 'nullable|integer|min:0',
            'passport' => 'required|file|mimes:pdf|max:102400',
            'emirates_id' => 'required|file|mimes:pdf|max:102400',
            'bank_statement' => 'required|file|mimes:pdf|max:102400',
            'trade_license' => 'nullable|file|mimes:pdf|max:102400',
            'vat_registration_certificate' => 'nullable|file|mimes:pdf|max:102400',
            'etihad_credit_bureau' => 'nullable|file|mimes:pdf|max:102400',
        ];
    }
}
