<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dni' => ['nullable', 'string', 'max:45'],
            'email' => ['nullable', 'email', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'dni.exists' => "El DNI proporcionado no pertenece a un cliente activo",
            'email.exists' => "El email proporcionado no pertenece a un cliente activo",
            'dni.string' => "El campo DNI debe ser una cadena de caracteres",
            'dni.max' => "El campo DNI no puede tener más de :max caracteres",
            'email.string' => "El campo email debe ser una cadena de caracteres",
            'email.max' => "El campo email no puede tener más de :max caracteres",
        ];
    }
}