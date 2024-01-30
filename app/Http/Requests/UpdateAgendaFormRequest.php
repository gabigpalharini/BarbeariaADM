<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAgendaFormRequest extends FormRequest
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
            'profissional_id'=>'integer|required_if:profissional_id,null',
            'data_hora'=>'date|required_if:data_hora,null',
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
            'profissional_id.required' => 'O ID é obrigatório',
            'profissional_id.integer' => 'O ID deve ser um número inteiro',
            'data_hora.required' => 'Data e hora obrigatório',
            'data_hora.date' => 'O campo deve conter apenas a data e a hora',
        ];
    }
}

/*
<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAgendaFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'profissional_id'=>'integer|required_if:profissional_id,null',
            'cliente_id'=>'integer',
            'servico_id'=>'integer',
            'data_hora'=>'date|required_if:data_hora,null',
            'tipo_pagamento'=>'max:20|min:3',
            'valor'=>'required|decimal:2',
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
            'profissional_id.required' => 'O ID é obrigatório',
            'profissional_id' => 'O ID deve ser um número inteiro',
            'cliente_id' => 'O ID deve ser um número inteiro',
            'servico_id' => 'O ID deve ser um número inteiro',
            'data_hora.required' => 'Data e hora obrigatório',
            'data_hora.dateTime' => 'O campo deve conter apenas a data e a hora',
            'tipo_pagamento.max' => 'Tipo de pagamento deve conter no máximo 120 caracteres',
            'tipo_pagamento.min' => 'Tipo de pagamento deve conter no mínimo 3 caracteres',
            'valor.decimal' => 'O campo deve conter casas de decimais',
        ];
    }
}
*/