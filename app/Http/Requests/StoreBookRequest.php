<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id' ,
            'title' => 'string|required|max:255' ,
            'author' => 'string|required|max:255' ,
            'description' => 'string|nullable' ,
            'total_copies' => 'integer|required|min:0' ,
            'available_copies' => 'integer|required|min:0' ,
            'degraded_copies' => 'integer|required|min:0' ,
            
        ];
    }
}
