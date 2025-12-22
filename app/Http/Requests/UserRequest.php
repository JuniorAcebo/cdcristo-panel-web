<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],

            'password' => $this->isMethod('post')
                ? 'required|min:8|confirmed'
                : 'nullable|min:8|confirmed',

            // 👇 CLAVE
            'is_admin' => $this->isMethod('post')
                ? 'boolean'
                : 'prohibited',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ser un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'is_admin.required' => 'Debe indicar el rol del usuario.',
            'is_admin.boolean' => 'El rol seleccionado no es válido.',
        ];
    }
}
