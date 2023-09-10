<?php

namespace App\Http\Requests\MultimediaHub;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
                'title' => ['sometimes', 'string', 'max:255'],
                'description' => ['sometimes','string'],
                'company_logo' => ['sometimes', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'location' => ['sometimes'],
                'salary' => ['sometimes', 'numeric'],
                'company' => ['sometimes'],
                'type' => ['sometimes', 'in:full-time,part-time,piece'],
                'place' => ['sometimes', 'in:office,remotly'],
                'deadline' => ['sometimes', 'date'],
            ];

        }else{
            return [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required','string'],
                'company_logo' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
                'location' => ['required'],
                'salary' => ['required', 'numeric'],
                'company' => ['required'],
                'type' => ['required', 'in:full-time,part-time,piece'],
                'place' => ['required', 'in:office,remotly'],
                'deadline' => ['required', 'date'],
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
            'title.required' => 'يرجى ادخال عنوان الوظيفة',
            'title.string' => 'عنوان الوظيفة يجب ان يكون نص',
            'title.max' => 'عنوان الوظيفة لا يجب ان يكون اكثر من :max حرفاً',
            'description.string' => 'وصف الوظيفة يجب ان يكون نص',
            'salary.numeric' => ' الراتب يجب ان يكون قيمة عددية',
            'location.required' => 'الرجاء ادخال المكان',
            'company.required' => 'الرجاء ادخال اسم الشركة',
            'type.required' => 'يرجى ادخال نوع العمل',
            'place.required' => 'يرجى ادخال طبيعة العمل',
            'company_logo.image' => 'يرجى ادخال شعار الشركة',
            'company_logo.mimes' => 'الصورة يجب ان تكون بامتداد jpeg او jpg او png.',
            'company_logo.max' => 'يجب أن لا يتعدى حجم الصورة :max كيلوبايت',
            'deadline.required' => 'يرجى ادخال الموعد النهائي للتقديم',
        ];
    }
}
