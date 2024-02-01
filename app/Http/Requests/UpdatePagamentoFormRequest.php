<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePagamentoFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'=>'max:120|min:10|unique:pagamentos,nome',
            'taxa'=>'min:2|max:4',
            'status'=>'max:15|min:5',
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
            'nome.min' => 'Nome deve conter no mínimo 10 caracteres',
            'nome.unique' => 'Nomejá cadastrado no sistema',
            'taxa.max' => 'Taxa deve conter no máximo 3 caracteres',
            'taxa.min' => 'Taxa deve conter no mínimo 2 caracteres',
            'status.max' => 'Condição deve conter no máximo 15 caracteres',
            'status.min' => 'Condição deve conter no máximo 5 caracteres',
        ];
    }
}
