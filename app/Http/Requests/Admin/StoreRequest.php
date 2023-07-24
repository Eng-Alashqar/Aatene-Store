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
    public function rules(): array
    {
        $rules = [];

        if ($this->method() === 'POST') {
            $rules = [
                'logo' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'cover' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'description' => ['required', 'string', 'max:64000'],
                'location' => ['required', 'string', 'max:64000'],
                'status' => ['sometimes', 'in:active,inactive'],
                'is_accepted' => ['sometimes', 'boolean'],
                'seller_id'=> ['required', 'exists:sellers,id'],
                'regions'=> ['required', 'exists:regions,id'],
            ];
        } elseif ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules = [
                'status' => ['required', 'in:active,blocked,inactive'],
                'block_reason' => ['nullable', 'string','max:255'],

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
            'status' => ['required' => 'الحالة مطلوبة.', 'in' => 'الحالة يجب أن تكون مفعلة أو في اجازة .'],
            'is_accepted' => ['sometimes' => 'قبول اضافة المتجر مطلوبة.', 'boolean' => 'الموافقة يجب أن تكون قبول أو رفض.'],
            'seller_id'=>['required' => 'حقل  المستخدم مطلوب.', 'exists' => 'هذا المستخدم غير موجود اختر مستخدم حقيقي.',],
            'regions'=>['required' => 'المناطق المدعومة مطلوبة .', 'exists' => 'هذه المناطق غير موجود اختر مناطق مدرجة.'],
            'block_reason' => ['nullable' => 'السبب (اختياري).', 'string' => 'يجب أن يكون الاسم نصًا.', 'max' => 'الاسم يجب أن يحتوي على 255 حرف كحد أقصى.'],
            'location' => ['required' => 'الموقع مطلوب.', 'string' => 'يجب أن يكون الموقع نصًا.', 'max' => 'الموقع يجب أن يحتوي على 255 حرف كحد أقصى.'],

        ];
    }
}
