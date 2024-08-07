<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //'id' => 'required|integer|exists:companies,id',
            'name' => 'required|string|max:255',
            'cif' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies')->ignore($this->id)->whereNull('deleted_at'),
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
            //'id.required' => 'El campo ID es obligatorio.',
            //'id.integer' => 'El campo ID debe ser un número entero.',
            //'id.exists' => 'El ID proporcionado no existe en la base de datos.',
            
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            
            'cif.required' => 'El CIF es obligatorio.',
            'cif.string' => 'El CIF debe ser una cadena de texto.',
            'cif.max' => 'El CIF no puede tener más de 50 caracteres.',
            'cif.unique' => 'El CIF ya está en uso. Por favor, ingresa uno diferente.',
            
            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser una cadena de texto.',
            'color.max' => 'El color no puede tener más de 7 caracteres.',
            
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no puede tener más de 255 caracteres.',
            
            'population.string' => 'La población debe ser una cadena de texto.',
            'population.max' => 'La población no puede tener más de 255 caracteres.',
            
            'cp.string' => 'El código postal debe ser una cadena de texto.',
            'cp.max' => 'El código postal no puede tener más de 10 caracteres.',
            
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no puede tener más de 20 caracteres.',
            
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            
            'logo.image' => 'El archivo debe ser una imagen.',
            'logo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'La imagen no puede tener más de 2048 kilobytes.',
        ];
    }
}
