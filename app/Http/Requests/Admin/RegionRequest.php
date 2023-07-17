<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'name'=>['required','string','max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'name'=>['required'=>'الاسم مطلوب','string'=>'هذا الحقل يجب ان يكون نص','max'=>'اقصى عدد احرف هو 255']
        ];
    }
}
