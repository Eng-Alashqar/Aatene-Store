<?php

namespace App\Http\Requests\Store;

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
        if ($this->method() === 'PUT') {
            return [
                'image' => ['sometimes', 'required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required','string'],
                'files'=>['nullable','string'],
                'price' => ['required', 'numeric', 'min:0'],
                'compare_price' => ['required', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:0'],
                'is_available' => ['nullable','boolean'],
                'status' => ['required', 'in:active,draft,archived'],
                'category_id' => ['required', 'exists:categories,id'],
                'tags' => ['nullable'],
                'featured'=>['nullable','boolean'],
                'options'=>['nullable'],
                'region_id_.*'=>['required','exists:regions,id'],
                'region_price_.*'=>['required']

            ];
        } else {
            return [
                'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required','string'],
                'files'=>['required','string'],
                'price' => ['required', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:0'],
                'is_available' => ['nullable','boolean'],
                'status' => ['required', 'in:active,draft,archived'],
                'category_id' => ['required', 'exists:categories,id'],
                'tags' => ['nullable','string'],
                'featured'=>['nullable','boolean'],
                'options.*.attribute'=>['required','in:color,size,style,material'],
                'options.*.options_value.*.options_value_photo'=>['required','image', 'mimes:jpeg,jpg,png,gif', 'max:102485'],
                'options.*.options_value.*.options_value_value'=>['required','string',  'max:100'],
                'options.*.options_value.*.options_value_price'=>['required','numeric', 'min:0'],
                'region_id_.*'=>['required','exists:regions,id'],
                'region_price_.*'=>['required']
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
            'options.*.attribute.required'=>'يرجى اختيار قيمة للخصائص',
            'options.*.attribute.in'=>' يرجى اختيار قيمة الخصائص واحدة من القيم الاتية إما لون او حجم او مادة او تنسيق ',
            'options.*.options_value.*.options_value_photo.required'=>'صورة خاصية المنتج مطلوبة',
            'options.*.options_value.*.options_value_photo.image'=>'صورة خاصية المنتج يجب ان تكون صورة',
            'options.*.options_value.*.options_value_photo.mimes'=>'صورة خاصية المنتج يجب ان تكون احد الانواع الاتية:jpeg,jpg,png,gif',
            'options.*.options_value.*.options_value_photo.max'=>'صورة خاصية المنتج لا يجب ان يزيد حجمها عن 1 ميجا',
            'options.*.options_value.*.options_value_value.required'=>'قيمة خاصية المنتج مطلوب ',
            'options.*.options_value.*.options_value_value.string'=>'قيمة خاصية المنتج يجب ان تكون نص ',
            'options.*.options_value.*.options_value_value.max'=>'قيمة خاصية المنتج يجب ان تكون نص لايزيد عن 100 خانة  ',
            'options.*.options_value.*.options_value_price.required'=>'سعر خاصية المنتج مطلوب ',
            'options.*.options_value.*.options_value_price.numeric'=>'سعر خاصية المنتج يجب ان يكون قيمة عددية ',
            'options.*.options_value.*.options_value_price.min'=>'سعر خاصية المنتج لا يجب ان يقل عن 0',

        ];
    }
}
