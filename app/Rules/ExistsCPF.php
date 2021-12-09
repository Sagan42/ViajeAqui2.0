<?php

namespace App\Rules;
use App\Models\Usuario;

use Illuminate\Contracts\Validation\Rule;

class ExistsCPF implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    // verifica se o CPF já está cadastrado
    public function passes($attribute, $value)
    {
      
        return ! Usuario::where('cpf', $value)->exists();
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse CPF já está cadastrado no sistema.';
    }
}