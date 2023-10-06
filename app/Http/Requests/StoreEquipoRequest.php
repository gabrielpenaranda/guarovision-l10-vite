<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipoRequest extends FormRequest
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
            'serial' => "required|min:2|max:100",
            'pon' => "required|min:2|max:100",
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
            'serial.required' => 'El serial es requerido',
            'serial.min' => 'El serial debe tener al menos dos (2) caracteres',
            'serial.max' => 'El serial debe tener máximo de cien (100) caracteres',
            'pon.required' => 'El identificador (PON) es requerido',
            'pon.min' => 'El identificador (PON) debe tener al menos dos (2) caracteres',
            'pon.max' => 'El identificador (PON) debe tener máximo de cien (100) caracteres',
        ];
    }
}
