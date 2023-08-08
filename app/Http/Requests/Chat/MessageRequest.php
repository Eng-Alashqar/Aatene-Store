<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'body' => ['required', 'string'],
            'conversation_id' => ['nullable', 'int', 'exists:conversations,id'],
            'participant_id' => ['required_without:conversation_id', 'nullable', 'int'],
            'participant_type' => ['required_with:participant_id', 'string', 'in:admin,seller,user'],
        ];
    }
}
