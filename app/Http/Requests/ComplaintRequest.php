<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email',
            'building_villa' => 'required|string|max:255',
            'flat_no' => 'required|string|max:50',
            'complaints' => 'required|array',
            'complaint_details' => 'required|string',
            'suggestion' => 'nullable|string',
        ];
    }
}
