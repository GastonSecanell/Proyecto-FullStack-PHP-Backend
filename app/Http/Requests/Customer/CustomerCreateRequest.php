<?php

namespace App\Http\Requests\Customer;

use App\Rules\Customer\CheckComuneRegionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerCreateRequest extends FormRequest
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
            'id_reg' => ['required', Rule::exists('regions', 'id_reg')],
            'id_com' => ['required', Rule::exists('communes', 'id_com'), new CheckComuneRegionRule($this->input('id_reg'), $this->input('id_com'))],
            'dni' => ['required', 'string', 'max:45', 'unique:customers,dni'],
            'email' => ['required', 'email', 'string', 'max:120', 'unique:customers,email'],
            'name' => ['required', 'string', 'max:45'],
            'last_name' => ['required', 'string', 'max:45'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'id_reg.required' => "El campo Region es obligatorio",
            'id_reg.exists' => "La región seleccionada no existe",
            'id_com.required' => "El campo Commune es obligatorio",
            'id_com.exists' => "La commune seleccionada no existe",
            'dni.required' => "El campo DNI es obligatorio",
            'dni.unique' => "El dni ingresado ya está registrado",
            'email.required' => "El campo email es obligatorio",
            'email.email' => "El email ingresado no es válido",
            'email.unique' => "El email ingresado ya está registrado",
            'name.required' => "El campo name es obligatorio",
            'last_name.required' => "El campo Apellido es obligatorio",
        ];
    }
}
