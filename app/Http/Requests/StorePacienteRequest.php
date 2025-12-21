<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorizar por defecto a todos los usuarios para realizar esta petición.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ci' => 'required|integer|unique:Pacientes,ci', // ci es obligatorio, debe ser un número entero único en la tabla.
            'nombre' => 'required|string|max:255', // nombre es obligatorio, debe ser una cadena de hasta 255 caracteres.
            'appaterno' => 'nullable|string|max:255', // apellido paterno es opcional, pero si se proporciona debe ser una cadena de hasta 255 caracteres.
            'apmaterno' => 'nullable|string|max:255', // apellido materno es opcional, pero si se proporciona debe ser una cadena de hasta 255 caracteres.
            'telefono' => 'nullable|integer|max:9999999999', // teléfono es opcional, debe ser un número entero y no mayor de 15 dígitos.
            'sexo' => 'required|in:M,F', // sexo es obligatorio, debe ser 'M' o 'F'.
            'seguro' => 'boolean', // seguro es opcional, debe ser verdadero o falso.
            'fechaSeAdquirido' => 'nullable|date',
            'fechaSeExpiracion' => 'nullable|date|after:fechaSeAdquirido',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ci.required' => 'El campo CI es obligatorio.',
            'ci.integer' => 'El CI debe ser un número entero.',
            'ci.unique' => 'El CI ya está registrado.',

            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            'appaterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'appaterno.max' => 'El apellido paterno no debe exceder los 255 caracteres.',
            'apmaterno.string' => 'El apellido materno debe ser una cadena de texto.',
            'apmaterno.max' => 'El apellido materno no debe exceder los 255 caracteres.',
            'telefono.integer' => 'El teléfono debe ser un número entero.',
            'telefono.max' => 'El teléfono no debe exceder los 15 dígitos.',
            'sexo.required' => 'El campo sexo es obligatorio.',
            'sexo.in' => 'El sexo debe ser M o F.',
            'fechaRegistro.required' => 'La fecha de registro es obligatoria.',
            'fechaRegistro.date' => 'La fecha de registro debe ser una fecha válida.',
            'seguro.boolean' => 'El campo seguro debe ser verdadero o falso.',
            'fechaSeAdquirido.date' => 'La fecha de adquisición debe ser una fecha válida.',
            'fechaSeExpiracion.date' => 'La fecha de expiración debe ser una fecha válida.',
        ];
    }
}
