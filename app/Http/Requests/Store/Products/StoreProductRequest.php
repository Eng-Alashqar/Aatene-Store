<?php

namespace App\Http\Requests\Store\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'is_available' => ['boolean'],
            'release_date' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,active,archived'],
            'category_id' => ['required', 'exists:categories,id'],
            'store_id' => ['exists:stores,id'],
            'image' => ['sometimes', 'required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
}
