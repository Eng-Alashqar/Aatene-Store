<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [];

        if ($this->method() === 'POST') {
            $rules = [
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:active,archive'],
                'parent_id'=> ['nullable', 'exists:categories,id'],
            ];
        } elseif ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules = [
                'image' => ['nullable', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:active,archive'],
                'parent_id'=> ['nullable', 'exists:categories,id'],
            ];
        } elseif ($this->method() === 'DELETE') {
            # code...
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'image.image' => 'يجب أن يكون الملف ملف صورة.',
            'image.mimes' => 'يجب أن يكون الملف من نوع: png, jpg, webm, jpeg, webp.',
            'image.max' => 'يجب ألا يتجاوز حجم الملف 1 ميجابايت.',
            'image.required' => 'الصورة مطلوب.',
            'name.required' => 'الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 100 حرف.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل.',
            'description.required' => 'الوصف مطلوب.',
            'description.string' => 'يجب أن يكون الوصف نصًا.',
            'description.max' => 'يجب ألا يتجاوز الوصف 64000 حرف.',
            'status.required' => 'الحالة مطلوبة.',
            'status.in' => 'الحالة غير صالحة.',
            'parent_id.exists' => 'الفئة الأصل غير صالحة.',
        ];
    }
}
