<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAgentPropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'agent_id' => 'required|exists:agents,id',
            'title' => 'required|array',
            'title.*' => 'required|string|max:255',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'location' => 'required|string|max:255',
            'property_type' => 'required|in:Residential,Commercial,Off-Plan,Mall,Villa',
            'transaction_type' => 'required|in:Rent,Sale',
            'price' => 'nullable|numeric',
            'area' => 'required|numeric',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:available,sold',
            'slug' => ['required', 'alpha_dash', Rule::unique('agent_properties', 'slug')->ignore($this->route('property'))],
        ];
    }
}
