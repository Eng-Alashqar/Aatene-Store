<?php

namespace App\Http\Requests\MultimediaHub;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
                'title' => ['sometimes', 'string','max:255'],
                'content' => ['sometimes','string','max:640000'],
                'is_published' => ['sometimes','boolean'],
                'image' => ['sometimes', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
            ];
        }else{
            return [
                'title' => ['required', 'string','max:255'],
                'content' => ['required','string','max:640000'],
                'is_published' => ['sometimes','boolean'],
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp','max:1024576'],
            ];
        }
    }
}
