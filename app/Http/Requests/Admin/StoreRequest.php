<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\ElseIf_;

class StoreRequest extends FormRequest
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
    public function rules($id = null): array
    {
        $rules = [];

        if ($this->method() === 'POST') {
            $rules = [
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:open,close'],
            ];
        } elseif ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules = [
                'image' => ['nullable', 'image', 'mimes:png,jpg,webm,jpeg,webp'],
                'name' => ['required', 'string', 'max:100', "unique:stores,name,$id"],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:open,close'],
            ];
        } elseif ($this->method() === 'DELETE') {
            # code...
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image' => ['nullable' => 'الصورة (اختياري).','required' => 'الصورة مطلوبة.', 'image' => 'يجب أن تكون الملف المحمل صورة.', 'mimes' => 'صيغة الملف يجب أن تكون png، jpg، webm، jpeg، أو webp.'],
            'name' => ['required' => 'الاسم مطلوب.', 'string' => 'يجب أن يكون الاسم نصًا.', 'max' => 'الاسم يجب أن يحتوي على 100 حرف كحد أقصى.', 'unique' => 'الاسم موجود بالفعل.'],
            'description' => ['required' => 'الوصف مطلوب.', 'string' => 'يجب أن يكون الوصف نصًا.', 'max' => 'الوصف يجب أن يحتوي على 64000 حرف كحد أقصى.'],
            'status' => ['required' => 'الحالة مطلوبة.', 'in' => 'الحالة يجب أن تكون مفتوحة أو مغلقة.'],
        ];
    }
}
