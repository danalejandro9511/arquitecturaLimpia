<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateCompanyRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'cif' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies')->whereNull('deleted_at'),
            ],
            'color' => 'required|string|max:7', 
            'address' => 'nullable|string|max:255',
            'population' => 'nullable|string|max:255',
            'cp' => 'nullable|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre  de la empresa es obligatorio.',
            'name.string' => 'El nombre de la empresa debe ser una cadena de texto.',
            'name.max' => 'El nombre de la empresa no debe exceder los 255 caracteres.',
            
            'cif.required' => 'El CIF es obligatorio.',
            'cif.string' => 'El CIF debe ser una cadena de texto.',
            'cif.max' => 'El CIF no debe exceder los 50 caracteres.',
            'cif.unique' => 'El CIF ya está en uso. Por favor, introduce un CIF único.',

            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no debe exceder los 7 caracteres.',

            'address.nullable' => 'La dirección es opcional.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no debe exceder los 255 caracteres.',

            'population.nullable' => 'La población es opcional.',
            'population.string' => 'La población debe ser una cadena de texto.',
            'population.max' => 'La población no debe exceder los 255 caracteres.',

            'cp.nullable' => 'El código postal es opcional.',
            'cp.string' => 'El código postal debe ser una cadena de texto.',
            'cp.max' => 'El código postal no debe exceder los 10 caracteres.',

            'phone.required' => 'El teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no debe exceder los 20 caracteres.',

            'email.nullable' => 'El correo electrónico es opcional.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',

            'logo.nullable' => 'El logo es opcional.',
            'logo.image' => 'El logo debe ser una imagen.',
            'logo.mimes' => 'El logo debe ser un archivo de tipo: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'El logo no debe exceder los 2048 kilobytes.',
        ];
    }
}
