<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateCPF;
use App\Rules\LoginCPF;
use App\Rules\FullPassword;

class LoginUserRequest extends FormRequest
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
     * @return array
     */

     //validações de Login
    public function rules()
    {
        return [

            'loginCPF' => ['required', new validateCPF, new LoginCPF],
            'loginSenha'=>['required', new FullPassword]
            //
        ];
    }

    public function messages () 
    {
        return [

            // Mensagens de erros de validação 
            'loginCPF.required' => 'O campo CPF é obrigatório.',
            'loginSenha.required' => 'O campo Senha é obrigatório.'
            
        ];
    }
}
