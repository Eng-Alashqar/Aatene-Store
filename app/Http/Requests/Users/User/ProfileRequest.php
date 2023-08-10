<?php

namespace App\Http\Requests\Users\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        if ($this->method() === 'POST') {
            return [
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'birthday' => ['required', 'date'],
                'gender' => ['required', 'in:male,female'],
                'street_address' => ['required', 'string'],
                'city' => ['required', 'string'],
                'state' => ['nullable', 'string'],
                'postal_code' => ['nullable'],
                'country' => ['required'],
                'locale' => ['nullable'],
            ];
        } else {
            return [
                'first_name' => ['sometimes', 'required', 'string'],
                'last_name' => ['sometimes', 'required', 'string'],
                'birthday' => ['sometimes', 'required', 'date'],
                'gender' => ['sometimes', 'required', 'in:male,female'],
                'street_address' => ['sometimes', 'required', 'string'],
                'city' => ['sometimes', 'required', 'string'],
                'state' => ['nullable', 'string'],
                'postal_code' => ['nullable'],
                'country' => ['sometimes', 'required'],
                'locale' => ['nullable'],
            ];
        }
    }
}
