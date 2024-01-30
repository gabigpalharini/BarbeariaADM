<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateClienteFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome'=>'max:120|min:5',
            'celular'=>'max:11|min:10',
            'email'=>'max:120|email:rfc|unique:clientes,email,' . $this -> id,
            'cpf'=>'max:11|min:11|unique:clientes,cpf,' . $this -> id,
            'dataNascimento'=>'date',
            'cidade'=>'max:120',
            'estado'=>'max:2|min:2',
            'pais'=>'max:80',
            'rua'=>'max:120',
            'numero'=>'max:10',
            'bairro'=>'max:100',
            'cep'=>'max:8|min:8',
            'complemento'=>'max:150',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages(){
        return [
            'nome.max' => 'Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 5 caracteres',
            'celular.max' => 'Celular deve conter no máximo 11 caracteres',
            'celular.min' => 'Celular deve conter no mínimo 10 caracteres',
            'email.max' => 'E-mail deve conter no máximo 120 caracteres',
            'email.email' => 'Formato de e-mail inválido',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',
            'dataNascimento.date' => 'O campo deve conter apenas datas',
            'cidade.max' => 'Cidade deve conter no máximo 120 caracteres',
            'estado.max' => 'Estado deve conter no máximo 2 caracteres',
            'estado.min' => 'Estado deve conter no mínimo 2 caracteres',
            'pais.max' => 'Pais deve conter no máximo 80 caracteres',
            'rua.max' => 'Nome deve conter no máximo 120 caracteres',
            'numero.max' => 'numero deve conter no máximo 10 caracteres',
            'bairro.max' => 'bairro deve conter no máximo 100 caracteres',
            'cep.max' => 'CEP deve conter no máximo 8 caracteres',
            'cep.min' => 'CEP deve conter no mínimo 8 caracteres',
            'complemento.max' => 'Complemento deve conter no máximo 150 caracteres',
        ];
    }
}