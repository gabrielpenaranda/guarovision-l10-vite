<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConceptoRequest extends FormRequest
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
            'concepto' => "required|unique:conceptos,concepto|min:3|max:50",
            'descripcion' => "required",
            'tarifa' => "required",
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
            'concepto.unique' => 'El concepto ya existe',
            'concepto.required' => 'El nombre del concepto es requerido',
            'concepto.min' => 'El nombre del concepto debe tener al menos tres (3) caracteres',
            'concepto.max' => 'El nombre del concepto debe tener máximo de cincuenta (50) caracteres',
            'descripcion.required' => 'La descripción de la divisa es requerida',
            'tarifa.required' => 'La tarifa es requerida',
        ];
    }
}
