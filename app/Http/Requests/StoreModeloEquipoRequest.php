<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeloEquipoRequest extends FormRequest
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
            'modelo_equipo' => "required|unique:modelo_equipos,modelo_equipo|min:2|max:100",
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
            'modelo_equipo.required' => 'El nombre del modelo de equipo es requerido',
            'modelo_equipo.unique' => 'El nombre del modelo de equipo ya existe',
            'modelo_equipo.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'modelo_equipo.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
