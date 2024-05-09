<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePedidos extends FormRequest
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
            'produto' => 'required|min:3|max:255',
            'valor' => 'required|min:1|max:10', //|unique:clientes
            'data' => 'required',
            'cliente_id' => 'required',
            'pedido_status_id' => 'required',
            'ativo' => 'required'
        ];

        if ($this->method() === 'PUT'){
            $rules['produto'] = [
                'required',
                'min:3',
                'max:255',
                Rule::unique('pedidos')->ignore($this->id),
            ];
            $rules['valor'] = [
                'required',
                'min:1',
                'max:10'
            ];
            $rules['data'] = [
                'required'
            ];
            $rules['cliente_id'] = [
                'required'
            ];
            $rules['pedido_status_id'] = [
                'required'
            ];
            $rules['ativo'] = [
                'required'
            ];

        }

        return $rules;
    }
}
