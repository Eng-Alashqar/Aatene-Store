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
            'name' => ['required','string', 'between:2,100'],
            'email' => ['required','string','email','max:100','unique:sellers,email','unique:users,email'],
            'password' => 'required|string|confirmed|min:6',
            'phone_number'=>['required','numeric'],
            'store_id'=>['sometimes','exists:stores,id','unique:sellers,store_id']
       ];
    }


}
