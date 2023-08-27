<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool)auth()->guard('seller')->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        if ($this->method() == 'PUT' || $this->method() == 'PATCH' ) {
            return [
                'image' => [ 'sometimes', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'name' => ['sometimes', 'string', 'max:255'],
                'description' => ['sometimes', 'string'],
                'files.*' => ['sometimes', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'price' => ['sometimes', 'numeric', 'min:0'],
                'quantity' => ['sometimes', 'integer', 'min:0'],
                'is_available' => ['sometimes', 'boolean'],
                'status' => ['sometimes', 'in:active,draft,archived'],
                'category_id' => ['sometimes', 'exists:categories,id'],
                'featured' => ['sometimes', 'boolean'],
            ];
        } else {
            return [
                'image' => ['required', 'required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'files.*' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'price' => ['required', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:0'],
                'is_available' => ['required', 'boolean'],
                'status' => ['required', 'in:active,draft,archived'],
                'category_id' => ['required', 'exists:categories,id'],
                'featured' => ['required', 'boolean'],
            ];
        }
    }
}
