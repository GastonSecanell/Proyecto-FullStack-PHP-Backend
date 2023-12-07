<?php

namespace App\Rules\Customer;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class CheckStatusCustomerRule implements Rule
{
    protected $customer;

    public function passes($attribute, $value)
    {   
        $this->customer = Customer::where('dni', $value)->first();

        return $this->customer && $this->customer->status !== 'trash';
    }

    public function message()
    {
        return $this->customer
            ? "Registro no existe"
            : "El cliente no existe";
    }
}

