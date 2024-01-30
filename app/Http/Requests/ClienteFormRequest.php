<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteFormRequest extends FormRequest
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
            'nome'=>'required|max:120|min:5',
            'celular'=>'required|max:11|min:10',
            'email'=>'required|max:120|email:rfc|unique:clientes,email',
            'cpf'=>'required|max:11|min:11|unique:clientes,cpf',
            'dataNascimento'=>'required|date',
            'cidade'=>'required|max:120',
            'estado'=>'required|max:2|min:2',
            'pais'=>'required|max:80',
            'rua'=>'required|max:120',
            'numero'=>'required|max:10',
            'bairro'=>'required|max:100',
            'cep'=>'required|max:8|min:8',
            'complemento'=>'max:150',
            'senha'=>'required',
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
            'nome.required' => 'Nome obrigatório',
            'nome.max' => 'Nome deve conter no máximo 120 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 5 caracteres',
            'celular.required' => 'Celular obrigatório',
            'celular.max' => 'Celular deve conter no máximo 11 caracteres',
            'celular.min' => 'Celular deve conter no mínimo 10 caracteres',
            'celular.integer' => 'Celular deve conter apenas números',
            'email.required' => 'E-mail obrigatório',
            'email.max' => 'E-mail deve conter no máximo 120 caracteres',
            'email.email' => 'Formato de e-mail inválido',
            'email.unique' => 'E-mail já cadastrado no sistema',
            'cpf.required' => 'CPF obrigatório',
            'cpf.max' => 'CPF deve conter no máximo 11 caracteres',
            'cpf.min' => 'CPF deve conter no mínimo 11 caracteres',
            'cpf.unique' => 'CPF já cadastrado no sistema',
            'dataNascimento.required' => 'Data de nascimento obrigatório',
            'dataNascimento.date' => 'O campo deve conter apenas datas',
            'cidade.required' => 'Cidade obrigatório',
            'cidade.max' => 'Cidade deve conter no máximo 120 caracteres',
            'estado.required' => 'Estado obrigatório',
            'estado.max' => 'Estado deve conter no máximo 2 caracteres',
            'estado.min' => 'Estado deve conter no mínimo 2 caracteres',
            'pais.required' => 'País obrigatório',
            'pais.max' => 'Pais deve conter no máximo 80 caracteres',
            'rua.required' => 'Rua obrigatório',
            'rua.max' => 'Nome deve conter no máximo 120 caracteres',
            'numero.required' => 'Número obrigatório',
            'numero.max' => 'numero deve conter no máximo 10 caracteres',
            'bairro.required' => 'Bairro obrigatório',
            'bairro.max' => 'bairro deve conter no máximo 100 caracteres',
            'cep.required' => 'CEP obrigatório',
            'cep.max' => 'CEP deve conter no máximo 8 caracteres',
            'cep.min' => 'CEP deve conter no mínimo 8 caracteres',
            'complemento.max' => 'Complemento deve conter no máximo 150 caracteres',
            'senha.required' => 'Senha obrigatório',
        ];
    }
}