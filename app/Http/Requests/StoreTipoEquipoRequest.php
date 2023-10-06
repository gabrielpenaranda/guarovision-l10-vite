<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoEquipoRequest extends FormRequest
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
            'tipo_equipo' => "required|unique:tipo_equipos,tipo_equipo|min:2|max:100",
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
            'tipo_equipo.required' => 'El nombre del tipo de equipo es requerido',
            'tipo_equipo.unique' => 'El nombre del tipo de equipo ya existe',
            'tipo_equipo.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'tipo_equipo.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
