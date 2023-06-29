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
                'logo' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'cover' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:active,inactive'],
            ];
        } elseif ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules = [
                'logo' => ['nullable', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'cover' => ['nullable', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', "unique:stores,name,$id"],
                'description' => ['required', 'string', 'max:64000'],
                'status' => ['required', 'in:active,inactive'],
            ];
        } elseif ($this->method() === 'DELETE') {
            # code...
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'logo' => ['nullable' => 'الصورة (اختياري).','required' => 'صورة اللوغو مطلوبة.', 'image' => 'يجب أن تكون الملف المحمل صورة.', 'mimes' => 'صيغة الملف يجب أن تكون png، jpg، webm، jpeg، أو webp.'],
            'cover' => ['nullable' => 'الصورة (اختياري).','required' => 'صورة اللافتة مطلوبة.', 'image' => 'يجب أن تكون الملف المحمل صورة.', 'mimes' => 'صيغة الملف يجب أن تكون png، jpg، webm، jpeg، أو webp.'],
            'name' => ['required' => 'الاسم مطلوب.', 'string' => 'يجب أن يكون الاسم نصًا.', 'max' => 'الاسم يجب أن يحتوي على 100 حرف كحد أقصى.', 'unique' => 'الاسم موجود بالفعل.'],
            'description' => ['required' => 'الوصف مطلوب.', 'string' => 'يجب أن يكون الوصف نصًا.', 'max' => 'الوصف يجب أن يحتوي على 64000 حرف كحد أقصى.'],
            'status' => ['required' => 'الحالة مطلوبة.', 'in' => 'الحالة يجب أن تكون مفتوحة أو مغلقة.'],
        ];
    }
}
