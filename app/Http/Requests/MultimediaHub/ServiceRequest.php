<?php

namespace App\Http\Requests\MultimediaHub;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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


        if ($this->method() === 'PUT' || $this->method() === 'PATCH'){
            return [
                'name' => ['sometimes', 'string','max:255'],
                'duration' => ['sometimes', 'integer', 'min:0'],
                'price' => ['sometimes', 'numeric', 'min:0'],
                'location' => ['sometimes', 'string', 'max:255'],
                'description' => ['sometimes','string','max:640000'],
                'active' => ['sometimes','boolean'],
                'image' => ['sometimes', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
            ];
        }else{
            return [
                'name' => ['required', 'string','max:255'],
                'duration' => ['required', 'integer', 'min:0'],
                'price' => ['required', 'numeric', 'min:0'],
                'location' => ['sometimes', 'string', 'max:255'],
                'description' => ['required','string','max:640000'],
                'active' => ['required','boolean'],
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
            ];
        }
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم الخدمة مطلوب',
            'name.string' => 'اسم الخدمة يجب ان يكون نص',
            'name.max' => 'اسم الخدمة لا يحب ان يكون اكثر من :max حرفاً',
            'description.required' => 'وصف الخدمة مطلوب',
            'description.string' => 'وصف الخدمة يجب ان يكون نص',
            'price.required' => 'الرجاء ادخال سعر الخدمة',
            'price.numeric' => 'سعر الخدمة يجب ان يكون قيمة عددية',
            'price.min' => 'يجب ان يكون السعر على الأقل :min',
            'duration.required' => 'الرجاء ادخال المدة الزمنية الخدمة',
            'duration.integer' => 'المدة الزمنية الخدمة يجب ان يكون رقما',
            'duration.min' => 'يجب ان تكون المدة الزمنية للخدمة على الأقل :min',
            'image.required' => 'يرجى رفع صورة للمنتج',
            'image.image' => 'يجب ادخال صورة الخدمة',
            'image.mimes' => 'الصورة يجب ان تكون بامتداد jpeg او jpg او png.',
            'image.max' => 'يجب أن لا يتعدى حجم الصورة :max كيلوبايت',
        ];
    }
}
