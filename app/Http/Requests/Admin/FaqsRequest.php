<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqsRequest extends FormRequest
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
            'question'=>['required','string','max:1000'],
            'answer'=>['required','string','max:4000'],
        ];
    }

    public function messages()
    {
        return [
            'question' => ['required' => 'السؤال مطلوب.', 'string' => 'يجب أن يكون الاسم نصًا.', 'max' => 'الاسم يجب أن يحتوي على 1000 حرف كحد أقصى.'],
            'answer' => ['required' => 'الإجابة مطلوب.', 'string' => 'يجب أن يكون الوصف نصًا.', 'max' => 'الوصف يجب أن يحتوي على 4000 حرف كحد أقصى.'],
        ];
    }
}
