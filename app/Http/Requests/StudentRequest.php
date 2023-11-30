<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'classroom_id' => ['required'],
            'name' => ['required', 'max:255', 'min:5'],
            'birth' => ['required'],
            'sex' => ['required', 'max:255'],
            'cpf' => ['required', 'min:11', 'max:14'],
            'address' => ['required',],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo é obrigatório!',
            'max' => 'Deve ter no máximo 255 caracteres!',
            'min' => 'Deve ter no minimo 5 caracteres',
            'cpf.min' => 'O CPF deve ter 11 caracteres!',
            'cpf.max' => 'O CPF deve ter 11 caracteres!',
            'integer' => 'Deve ser um número inteiro',
        ];
    }
}
