<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerNotificatoinRequest extends FormRequest
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
            'title'=>'required|string|min:3|max:250',
            'content'=>'required|string|min:3|max:2555',
            'type'=>'required|in:app,email,sms',

            'users' =>'nullable|array',

            "users.*" =>'nullable|exists:users,id',

        ];
    }

    public function getData()
    {
        $data = $this->all();
        $data['users'] = array_unique($data['users']??[]);
        return $data ;
    }



    }
