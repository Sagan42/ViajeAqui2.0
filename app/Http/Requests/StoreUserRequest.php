<?php

namespace App\Http\Requests;

use App\Rules\ExistsCPF;
use App\Rules\ExistsEmail;
use App\Rules\FullName;
use App\Rules\FullPassword;
use App\Rules\ValidateCPF;
use App\Rules\ValidateEmail;
use App\Rules\validateName;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
    // validações do cadastro do usuário
    public function rules()
    {
        return [

            'cadNome' => ['required','string', new FullName, new validateName],
            'cadSenha' => ['required', new FullPassword],
            'cadConfSenha' => "same:cadSenha",
            'cadCPF' => ['required', new ValidateCPF, new ExistsCPF],
            'cadCelular' => ['required', 'digits_between:11,11'],
            'cadEmail' => ['required', new ValidateEmail, new ExistsEmail],
            'cadConfEmail' => "same:cadEmail"
        
            
        ];
    }
    //mensagens de validações
    public function messages () 
    {
        return [
            // Mensagens de erros de validação 
            'cadNome.required' => 'O campo nome é obrigatório.',


            'cadSenha.required' => 'O campo senha é obrigatório.',
            'cadConfSenha.same' => 'A confirmação da senha está inválida.',

            'cadCPF.required' => 'O campo cpf é obrigatório.',

            'cadCelular.required' => 'O campo celular é obrigatório.',
            'cadCelular.digits_between' => 'número de telefone inválido.',

            'cadEmail.required' => 'O campo email é obrigatório.',
            'cadConfEmail.same' => " A confirmação do email está inválida."

            

        ];
    }
}
