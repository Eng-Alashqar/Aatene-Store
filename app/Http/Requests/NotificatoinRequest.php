<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificatoinRequest extends FormRequest
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
            'content'=>'required|string|min:3|max:2500',
            'type'=>'required|in:app,email,sms',
            'followers' =>'nullable|array',
            'users' =>'nullable|array',
            'sellers' =>'nullable|array',

            "users.*" =>'nullable|exists:users,id',
            "sellers.*" =>'nullable|exists:sellers,id',
            "followers.*" =>'nullable|exists:stores,id',
        ];
    }

    public function getData()
    {
        $data = $this->all();

        $data['followers'] = array_unique($data['followers']??[]);
        $data['users'] = array_unique($data['users']??[]);
        $data['sellers'] = array_unique($data['sellers']??[]);

        return $data ;
    }



    }
