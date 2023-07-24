<?php

namespace App\Http\Requests\Shared;

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
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'integer', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'active' => ['boolean'],
            'category_id' => ['required', 'exists:categories,id'],
            'store_id' => ['exists:stores,id'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
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
