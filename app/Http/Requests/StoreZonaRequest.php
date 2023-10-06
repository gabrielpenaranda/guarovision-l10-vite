<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreZonaRequest extends FormRequest
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
            'zona' => "required|unique:zonas,zona|min:2|max:100",
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
            'zona.required' => 'El nombre de la zona es requerido',
            'zona.unique' => 'El nombre de la zona ya existe',
            'zona.min' => 'El nombre debe tener al menos dos (2) caracteres',
            'zona.max' => 'El nombre debe tener máximo de cien (100) caracteres',
        ];
    }
}
