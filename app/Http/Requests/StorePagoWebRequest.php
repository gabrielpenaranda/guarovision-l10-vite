<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoWebRequest extends FormRequest
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
            'monto' => "required",
            'num_referencia' => "required",
            'realizado_por' => "required",
            'telefono_celular' => "required",
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
            'monto.required' => 'El monto es requerido',
            'num_referencia.required' => 'El número de transferencia/pago móvil es requerido',
            'realizado_por.required' => 'El nombre de la persona que realiza el pago requerido',
            'telefono_celular.required' => 'El teléfono celular es requerido',
        ];
    }
}