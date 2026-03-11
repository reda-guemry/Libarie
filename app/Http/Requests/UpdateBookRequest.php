<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categorie_id' => 'sometimes|exists:categories,id',
            'title' => 'string|sometimes|max:255',
            'author' => 'string|sometimes|max:255',
            'description' => 'string|nullable',
            'total_copies' => 'integer|sometimes|min:0',
            'available_copies' => 'integer|sometimes|min:0',
            'degraded_copies' => 'integer|sometimes|min:0',
        ];
    }
}
