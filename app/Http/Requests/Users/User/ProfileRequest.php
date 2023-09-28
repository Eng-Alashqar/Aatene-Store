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
        if ($this->method() =='PUT' || $this->method() == 'PATCH' ){
            return [
                'image' => ['sometimes', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['sometimes','string', 'between:2,100'],
                'first_name' => ['sometimes','string', 'between:2,100'],
                'last_name' => ['sometimes','string', 'between:2,100'],
                'email' => ['sometimes','string','email','max:100','unique:sellers,email','unique:users,email'],
                'phone_number'=>['sometimes','numeric'],
                'birthday'=>['sometimes','date', 'before:today'],
                'gender'=>['sometimes','in:male,female'],
                'country'=>['sometimes','string', 'size:2'],
                'street_address' => ['sometimes','string', 'between:2,100'],
                'city' => ['sometimes','string', 'between:2,50'],
                'state'=>['sometimes','string', 'between:2,50'],
                'postal_code'=>['sometimes','string', 'between:2,20'],
                'locale'=>['sometimes','string', 'between:2,10'],
            ];
        }else{
            return [
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'first_name' => ['required','string', 'between:2,100'],
                'last_name' => ['required','string', 'between:2,100'],
                'email' => ['required','string','email','max:100','unique:sellers,email','unique:users,email'],
                'phone_number'=>['required','numeric'],
                'birthday'=>['required','date', 'before:today'],
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
}
