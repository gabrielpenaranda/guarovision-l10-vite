<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoWebRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => "required",
            'cedula' => "required",
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
            'tipo.required' => 'Debe señalar V ó E',
            'cedula.required' => 'Debe introducir la cédula de identidad',
        ];
    }
}