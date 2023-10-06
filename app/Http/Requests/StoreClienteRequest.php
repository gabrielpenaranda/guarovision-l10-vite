<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Request;
// use App\Rules\CodigoVerificationRule;

class StoreClienteRequest extends FormRequest
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
        //$cedula = $request->get("cedula");
        return [
            'apellidos' => "required|max:30",
            'nombres' => "required|max:30",
            'cedula' => "required|min:3|max:10",
            'email' => "max:80",
            'telefono_fijo' => "max:50",
            'telefono_celular' => "max:50",
            'direccion' => "required|max:250",
            'foto' => 'image|mimes:jpeg,png,jpg|max:1024',
            'imagen_cedula' => 'image|mimes:jpeg,png,jpg|max:1024'
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
            'apellidos.required' => 'El(los) apellido(s) es(son) requeridos',
            'apellidos.max' => 'El(los) apellido(s) debe(n) tener máximo de treinta (30) caracteres',
            'nombres.required' => 'El(los) nombre(s) es(son) requeridos',
            'nombres.max' => 'El(los) nombre(s) debe(n) tener máximo de treinta (30) caracteres',
            'cedula.required' => 'El número de cédula es requerido',
            'cedula.min' => 'El número de cédula debe tener al menos tres (3) caracteres',
            'cedula.max' => 'El número de cédula debe tener máximo de diez (10) caracteres',
            'telefono_fijo.max' => 'El teléfono fijo debe tener máximo cincuenta (50) caracteres',
            'telefono_celular.max' => 'El teléfono celular debe tener máximo cincuenta (50) caracteres',
            'direccion.required' => 'La dirección es requerida',
            'direccion.max' => 'la dirección debe tener máximo doscientos cincuenta (250) caracteres',
            'email.max' => 'El email debe tener máximo de ochenta (80) caracteres',
        ];
    }
}
