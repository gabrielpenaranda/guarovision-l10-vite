<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDivisaRequest extends FormRequest
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
            'descripcion' => "required|min:2|max:100",
            'simbolo' => "required|min:1|max:7",
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
            'descripcion.required' => 'La descripción de la divisa es requerida',
            'descripcion.min' => 'La descripción de la divisa debe tener al menos dos (2) caracteres',
            'descripcion.max' => 'La descripción de la divisa debe tener máximo de cien (100) caracteres',
            'simbolo.required' => 'El simbolo es requerido',
            'simbolo.min' => 'El simbolo debe tener al menos un (1) caracter',
            'simbolo.max' => 'El simbolo debe tener máximo de cinco (7) caracteres',
        ];
    }
}
