<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class AdminRequest extends FormRequest
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
                'avatar' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'name' => ['required', 'string', 'max:100', 'unique:stores,name'],
                'phone_number' => ['required', 'numeric','digits_between:9,20'],
                'status' => ['required', 'in:active,blocked,inactive'],
                'role_ids.*'=> ['required', 'exists:roles,id'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(Admin::class),
                ],
                'password' => ['required', 'string', new Password, 'confirmed'],
            ];
        } elseif ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules = [
                'status' => ['required', 'in:active,blocked'],
                'role_ids.*'=> ['required', 'exists:roles,id'],
                'password' => ['nullable', 'string', new Password, 'confirmed'],
            ];
        } elseif ($this->method() === 'DELETE') {
            # code...
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'avatar.required' => 'حقل الصورة مطلوب.',
            'avatar.image' => 'يجب أن يكون الصورة صورة.',
            'avatar.mimes' => 'يجب أن يكون الصورة من نوع png، jpg، webm، jpeg، أو webp.',
            'avatar.max' => 'يجب ألا يتجاوز حجم الصورة 1 ميجابايت.',
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يتجاوز الاسم 100 حرف.',
            'name.unique' => 'الاسم مستخدم بالفعل.',
            'phone_number.required' => 'حقل رقم الهاتف مطلوب.',
            'phone_number.numeric' => 'يجب أن يكون رقم الهاتف رقمًا.',
            'phone_number.max' => 'يجب ألا يتجاوز رقم الهاتف 64,000.',
            'status.required' => 'حقل الحالة مطلوب.',
            'status.in' => 'قيمة الحالة غير صحيحة.',
            'role_ids.*.required' => 'حقل الدور مطلوب.',
            'role_ids.*.exists' => 'قيمة الدور غير موجودة.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.string' => 'يجب أن يكون البريد الإلكتروني نصًا.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحًا.',
            'email.max' => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.nullable' => 'حقل كلمة المرور إختياري.',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ];

    }
}
