<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateCPF implements Rule
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
     * @param  mixed  $cpf
     * @return bool
     */
    // verifica se o CPF é válido 
    public function passes($attribute,$cpf)
    {
        
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    
    if (strlen($cpf) != 11) {
        return false;
    }

    
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF inserido é inválido.';
    }
}
