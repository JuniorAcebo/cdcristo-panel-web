<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOdontologoRequest extends FormRequest
{
    /**
     * Autoriza la petición
     */
    public function authorize(): bool
    {
        return true; // ⬅️ IMPORTANTE: sin esto te daba 403
    }

    /**
     * Reglas de validación
     */
    public function rules(): array
    {
        return [
            'ci' => 'required|numeric|unique:Pacientes,ci',
            'nombre' => 'required|string|max:255',
            'appaterno' => 'required|string|max:255',
            'apmaterno' => 'nullable|string|max:255',
            'telefono' => 'required|numeric',
            'sexo' => 'required|in:M,F',
            'idUsuario' => 'required|exists:users,id|unique:odontologos,idUsuario',
        ];
    }

    /**
     * Mensajes personalizados
     */
    public function messages(): array
    {
        return [
            'ci.required' => 'El CI es obligatorio.',
            'ci.numeric' => 'El CI debe contener solo números.',
            'ci.unique' => 'El CI ya está registrado.',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',

            'appaterno.required' => 'El apellido paterno es obligatorio.',
            'appaterno.string' => 'El apellido paterno debe ser texto.',

            'apmaterno.string' => 'El apellido materno debe ser texto.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',

            'sexo.required' => 'El género es obligatorio.',
            'sexo.in' => 'El género debe ser M o F.',
        ];
    }
}
