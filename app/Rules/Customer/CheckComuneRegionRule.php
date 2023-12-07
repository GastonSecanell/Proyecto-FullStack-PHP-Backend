<?php

namespace App\Rules\Customer;

use App\Models\Commune;
use Illuminate\Contracts\Validation\Rule;

class CheckComuneRegionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private $region, private $comune)
    {
        //
    }
   

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function passes($attribute, $value)
    {   
        $check = Commune::where([
            'id_reg' => $this->region,
            'id_com' => $this->comune
        ])
        ->exists();
            
        if ($check) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'ERROR... la comuna no pertenece a la region';
    }
}
