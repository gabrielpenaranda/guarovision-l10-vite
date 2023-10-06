<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaquillaRequest extends FormRequest
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
            'taquilla' => "required|unique:taquillas,taquilla|min:2|max:100",
            'direccion' => "required|min:2|max:100"
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
            'taquilla.required' => 'El nombre de la taquilla es requerido',
            'taquilla.unique' => 'El nombre de la taquilla ya existe',
            'taquilla.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'taquilla.max' => 'El nombre debe tener máximo de cien (100) caracteres',
            'direccion.required' => 'La dirección es requerida',
            'direccion.min' => 'La dirección debe tener al menos dos (2) caracteres',
            'direccion.max' => 'La dirección debe tener máximo de cien (100) caracteres',
        ];
    }
}
