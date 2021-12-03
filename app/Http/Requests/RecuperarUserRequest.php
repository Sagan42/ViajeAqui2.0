<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidateEmail;
use App\Rules\NoExistsEmail;
class RecuperarUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'Email' => ['required', new ValidateEmail, new NoExistsEmail ]
            
        ];
    }

    public function messages () 
    {

     return ['Email.required' => 'O campo email é obrigatório.'];

    }


}
