<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if($this->method() === 'PUT' || $this->method() === 'PATCH')
        {
            return [
                'name' => ['required',"unique:roles,name,$this->id"],
                'permission_ids.*' => ['required',"exists:permissions,id"],
            ];
        }
        return [
            'name' => ['required','unique:roles,name'],
            'permission_ids.*' => ['required','exists:permissions,id'],
        ];
    }
}
