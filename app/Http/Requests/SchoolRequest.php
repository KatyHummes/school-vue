<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'education' => ['required'],
            'course' => ['required'],
            'address' => ['required', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'max' => 'Deve ter no máximo 255 caracteres!'
        ];
    }
}
