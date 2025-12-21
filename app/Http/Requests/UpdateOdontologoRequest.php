<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOdontologoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'ci' => [
                'required',
                'integer',
                Rule::unique('pacientes', 'ci')->ignore($this->odontologo->id)
            ],
            'nombre' => 'required|string|max:255',
            'appaterno' => 'nullable|string|max:255',
            'apmaterno' => 'nullable|string|max:255',
            'telefono' => 'nullable|integer|digits_between:7,15',
            'sexo' => 'required|in:M,F',
            'seguro' => 'boolean',
            'fechaSeAdquirido' => 'nullable|date|required_if:seguro,true',
            'fechaSeExpiracion' => 'nullable|date|after:fechaSeAdquirido|required_if:seguro,true'
        ];
    }

    public function messages(): array
    {
        return [
            'ci.required' => 'El campo CI es obligatorio.',
            'ci.integer' => 'El CI debe ser un número entero.',
            'ci.unique' => 'El CI ya está registrado por otro odontologo.',
            // ... (mantén los demás mensajes igual)
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
            //afdsas
            'fechaSeAdquirido.required_if' => 'La fecha de adquisición es requerida cuando el seguro está activo.',
            'fechaSeExpiracion.required_if' => 'La fecha de expiración es requerida cuando el seguro está activo.',
            'fechaSeExpiracion.after' => 'La fecha de expiración debe ser posterior a la de adquisición.'
        ];
    }
}
