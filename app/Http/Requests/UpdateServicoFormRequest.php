<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateServicoFormRequest extends FormRequest
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
            'nome'=>'max:80|min:5',
            'descricao'=>'max:200|min:10',
            'duracao'=>'numeric',
            'preco'=>'decimal:2',
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
            'nome.max' => 'Nome deve conter no máximo 80 caracteres',
            'nome.min' => 'Nome deve conter no mínimo 5 caracteres',
            'nome.unique' => 'Nome já cadastrado no sistema',
            'descricao.max' => 'Descricao deve conter no máximo 200 caracteres',
            'descricao.min' => 'Descricao deve conter no mínimo 10 caracteres',
            'duracao.numeric' => 'Duracao deve conter apenas números',
            'preco.decimal' => 'Preco deve conter apenas casas decimais',
        ];
    }
}