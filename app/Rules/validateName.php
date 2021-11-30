<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validateName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $string = str_replace(' ', '', $value);
        
        return ctype_alpha($string);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ' Seu nome possui caracters inválidos.';
    }
}
