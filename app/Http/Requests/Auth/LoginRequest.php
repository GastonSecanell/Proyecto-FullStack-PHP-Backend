<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = false;
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
        ];
    }
    public function messages()
    {
        return [
        'email.required' => 'El email es un campo es obligatorio',
        'email.email' => 'Debe ingresar un email valido',
        'password.required' => 'El password es un campo obligatorio',
        ];
    }
}
