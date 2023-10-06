<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaEquipoRequest extends FormRequest
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
            'marca_equipo' => "required|unique:marca_equipos,marca_equipo|min:2|max:100",
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
            'marca_equipo.required' => 'El nombre de la marca de equipo es requerido',
            'marca_equipo.unique' => 'El nombre de la marca de equipo ya existe',
            'marca_equipo.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'marca_equipo.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
