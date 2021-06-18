<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nome' => 'required|string|regex:/^[\pL\s\-]+$/u|min:5',
            'idade' => 'required|integer',
            'email' => 'email:rfc,dns',
        ];
    }
    public function messages()
    {
        return [
            'min' => 'CAMPO DEVE CONTER NO MÍNIMO 5 CARACTERE',
            'integer' => 'DIGITE UM NÚMERO ',
            'email' => 'E-MAIL NÃO É VÁLIDO',
            'regex' => 'DIGITAR SOMENTE CARACTERE ALFABETICA'
        ];
    }
}
