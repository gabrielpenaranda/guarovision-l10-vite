<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImpuestoRequest extends FormRequest
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
            'impuesto' => "required|unique:impuestos,impuesto|min:3|max:50",
            'tasa' => "required",
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
            'impuesto.unique' => 'El impuesto ya existe',
            'impuesto.required' => 'El nombre del impuesto es requerido',
            'impuesto.min' => 'El nombre del impuesto debe tener al menos tres (3) caracteres',
            'impuesto.max' => 'El nombre del impuesto debe tener máximo de cincuenta (50) caracteres',
            'tasa.required' => 'La tasa del impuesto es requerida',
        ];
    }
}
