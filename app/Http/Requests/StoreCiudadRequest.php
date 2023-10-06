<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCiudadRequest extends FormRequest
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
            'ciudad' => "required|unique:ciudades,ciudad|min:2|max:100",
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
            'ciudad.required' => 'El nombre de la ciudad es requerido',
            'ciudad.unique' => 'El nombre de la ciudad ya existe',
            'ciudad.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'ciudad.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
