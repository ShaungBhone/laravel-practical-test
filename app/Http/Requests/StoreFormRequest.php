<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'dob' => 'nullable|date',
            'phone' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:5',
            'gender' => 'nullable|in:male,female',
        ];
    }
}
