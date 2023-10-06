<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBancoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => "required|unique:bancos,codigo|min:4|max:4",
            'banco' => "required|unique:bancos,banco|min:2|max:100",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'codigo.required' => 'El coóigo es requerido',
            'codigo.unique' => 'El código ya existe',
            'codigo.min' => 'El código debe tener cuatro (4) caracteres',
            'codigo.max' => 'El código debe tener cuatro (4) caracteres',
            'banco.required' => 'El nombre del banco es requerido',
            'banco.unique' => 'El nombre del banco ya existe',
            'banco.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'banco.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}