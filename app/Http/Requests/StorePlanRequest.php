<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
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
            'plan' => "required|unique:planes,plan|min:3|max:50",
            'descripcion' => "required",
            'tarifa' => "required",
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
            'plan.unique' => 'El plan ya existe',
            'plan.required' => 'El nombre del plan es requerido',
            'plan.min' => 'El nombre del plan debe tener al menos tres (3) caracteres',
            'plan.max' => 'El nombre del plan debe tener máximo de cincuenta (50) caracteres',
            'descripcion.required' => 'La descripción de la divisa es requerida',
            'tarifa.required' => 'La tarifa es requerida',
        ];
    }
}
