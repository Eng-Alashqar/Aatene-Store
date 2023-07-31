<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required','string', 'between:2,100'],
            'last_name' => ['required','string', 'between:2,100'],
            'email' => ['required','string','email','max:100','unique:sellers,email','unique:users,email'],
            'password' => 'required|string|confirmed|min:6',
            'phone_number'=>['required','numeric'],
            'birthday'=>['nullable','date', 'before:today'],
            'gender'=>['required','in:male,female'],
            'country'=>['required','string', 'size:2'],
            'street_address' => ['required','string', 'between:2,100'],
            'city' => ['required','string', 'between:2,50'],
            'state'=>['required','string', 'between:2,50'],
            'postal_code'=>['required','string', 'between:2,20'],
            'locale'=>['required','string', 'between:2,10'],
        ];
    }


}
