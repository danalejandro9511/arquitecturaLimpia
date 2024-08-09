<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CreateRetentionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|max:100', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la retención es obligatorio.',
            'name.string' => 'El nombre de la retención debe ser una cadena de texto.',
            'name.max' => 'El nombre de la retención no debe exceder los 255 caracteres.',
            
            'percentage.required' => 'El porcentaje de la retención es obligatorio.',
            'percentage.numeric' => 'El porcentaje de la retención debe ser un número.',
            'percentage.max' => 'El porcentaje de la retención no debe exceder el 100%.',
        ];
    }
}
