<?php

namespace App\Rules\Customer;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class CheckDniEmailCustomerRule implements Rule
{
    public function __construct(private $dni, private $email)
    {
        //
    }

    public function passes($attribute, $value)
    {   
        /* if (is_null($this->dni) && is_null($this->email)) {
            return false;
        } */

        /* if (!is_null($this->dni) && !is_null($this->email)) {
            return false;
        } */

        /* if (!is_null($this->dni)) {
            $this->customer = Customer::where('dni', $this->dni)->first();
            return $this->customer && $this->customer->status === Customer::CUSTOMER_ACTIVE;
        } */

        /* if (!is_null($this->email)) {
            $this->customer = Customer::where('email', $this->email)->first();
            return $this->customer && $this->customer->status === Customer::CUSTOMER_ACTIVE;
        } */

        return true;
    }

    public function message()
    {
        return 'ERROR... Debes proporcionar dni o email';
    }
}
