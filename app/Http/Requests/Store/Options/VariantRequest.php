<?php

namespace App\Http\Requests\Store\Options;

use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            return [
                'image' => ['sometimes', 'image', 'mimes:png,jpg,webm,jpeg,webp', 'max:1024576'],
                'name' => ['sometimes', 'string', 'max:100'],
                'price' => ['sometimes', 'numeric', 'min:0'],
                'is_available' => ['sometimes', 'boolean'],
                'product_id' => ['sometimes', 'exists:products,id'],
            ];
        } else {
            return [
                'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp', 'max:1024576'],
                'name' => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric', 'min:0'],
                'is_available' => ['required', 'boolean'],
                'product_id' => ['required', 'exists:products,id'],
            ];
        }

    }

}
