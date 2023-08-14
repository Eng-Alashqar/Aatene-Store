<?php

namespace App\Http\Requests\Store\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                'name' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'price' => ['nullable', 'numeric', 'min:0'],
                'quantity' => ['nullable', 'integer', 'min:0'],
                'is_available' => ['boolean'],
                'release_date' => ['nullable', 'date'],
                'status' => ['nullable', 'in:updated,new,expired'],
                'category_id' => ['nullable', 'exists:categories,id'],
                'store_id' => ['nullable', 'exists:stores,id'],
                'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'price' => ['sometimes', 'required', 'numeric', 'min:0'],
                'quantity' => ['sometimes', 'required', 'integer', 'min:0'],
                'is_available' => ['boolean'],
                'release_date' => ['nullable', 'date'],
                'status' => ['sometimes', 'required', 'in:updated,new,expired'],
                'category_id' => ['sometimes', 'required', 'exists:categories,id'],
                'store_id' => ['sometimes', 'required', 'exists:stores,id'],
                'image' => ['sometimes', 'required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            ];
        }
    }
}
