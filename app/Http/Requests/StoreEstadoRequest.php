<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstadoRequest extends FormRequest
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
            'estado' => "required|unique:estados,estado|min:2|max:100",
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
            'estado.required' => 'El nombre del estado es requerido',
            'estado.unique' => 'El nombre del estado ya existe',
            'estado.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'estado.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
