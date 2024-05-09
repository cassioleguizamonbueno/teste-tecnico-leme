<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateClientes extends FormRequest
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

        $rules = [
            'nome' => 'required|min:3|max:255',
            'cpf' => 'required|min:11|max:15|unique:clientes',
            'data_nasc' => 'required',
            'ativo' => 'required'
        ];

        if ($this->method() === 'PUT'){
            $rules['nome'] = [
                'required',
                'min:3',
                'max:255',
               // "unique:supports,subject,{this->id},id"
                Rule::unique('clientes')->ignore($this->id),
            ];
            $rules['cpf'] = [
                'required',
                'min:11',
                'max:15',
                Rule::unique('clientes')->ignore($this->id),
            ];
            $rules['data_nasc'] = [
                'required'
            ];
            $rules['ativo'] = [
                'required'
            ];

        }

        return $rules;
    }
}
