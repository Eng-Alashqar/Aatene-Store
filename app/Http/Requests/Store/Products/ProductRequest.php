<?php

namespace App\Http\Requests\Store\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => ['required','string'],
            'files'=>['required','string'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'is_available' => ['nullable','boolean'],
            'status' => ['required', 'in:active,draft,archived'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['nullable'],
            'featured'=>['nullable','boolean'],
            'options'=>['nullable'],
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
            'name.required' => 'اسم المنتج مطلوب',
            'name.string' => 'اسم المنتج يجب ان يكون نص',
            'name.max' => 'اسم المنتج لا يحب ان يكون اكثر من :max حرفاً',
            'description.required' => 'وصف المنتج مطلوب',
            'description.string' => 'وصف المنتج يجب ان يكون نص',
            'price.required' => 'الرجاء ادخال سعر المنتج',
            'price.numeric' => 'سعر المنتج يجب ان يكون قيمة عددية',
            'price.min' => 'يجب ان يكون السعر على الأقل :min',
            'quantity.required' => 'الرجاء ادخال كمية المنتج',
            'quantity.integer' => 'كمية المنتج يجب ان يكون رقما',
            'quantity.min' => 'يجب ان تكون الكمية على الأقل :min',
            'status.required' => 'مطلوب ادخال حالة المنتج',

        ];
    }
}
