<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOdontologoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ci' => [
                'required',
                'integer',
                Rule::unique('odontologos', 'ci')
                    ->ignore($this->route('odontologo')->id),
            ],

            'nombre'     => 'required|string|max:255',
            'appaterno'  => 'required|string|max:255',
            'apmaterno'  => 'nullable|string|max:255',
            'telefono'   => 'required|digits_between:7,15',
            'sexo'       => 'required|in:M,F',

            'idUsuario' => [
                'required',
                'exists:users,id',
                Rule::unique('odontologos', 'idUsuario')
                    ->ignore($this->route('odontologo')->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'ci.required' => 'El campo CI es obligatorio.',
            'ci.integer'  => 'El CI debe ser un número entero.',
            'ci.unique'   => 'El CI ya está registrado por otro odontólogo.',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.max'      => 'El nombre no debe exceder 255 caracteres.',

            'appaterno.required' => 'El apellido paterno es obligatorio.',
            'appaterno.string'   => 'El apellido paterno debe ser texto.',
            'appaterno.max'      => 'El apellido paterno no debe exceder 255 caracteres.',

            'apmaterno.string' => 'El apellido materno debe ser texto.',
            'apmaterno.max'    => 'El apellido materno no debe exceder 255 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',

            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in'       => 'El sexo debe ser M o F.',

            'idUsuario.required' => 'Debe seleccionar un usuario.',
            'idUsuario.exists'   => 'El usuario seleccionado no es válido.',
            'idUsuario.unique'   => 'Este usuario ya está asignado a otro odontólogo.',
        ];
    }
}
