<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role'     => ['sometimes', Rule::in(['admin', 'user'])]
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'El nombre del usuario es obligatorio',
            'name.string'        => 'El nombre del usuario debe ser unicamente letras, sin numeros o simbolos especiales',
            'name.max'           => 'El nombre del usuario no puede sobrepasar los 255 caracteres',
            'email.required'     => 'El correo del usuario es obligatorio',
            'email.email'        => 'El correo del usuario debe tener el formato indicado para un correo',
            'email.unique'       => 'El correo del usuario ya fue registrado, debe ingresar otro diferente ',
            'password.required'  => 'La contraseña del usuario es obligatoria',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
            'password.min'       => 'La confirmación debe contener minimo 6 caracteres',
            'role.in'            => 'Para el rol solo puede ser tipo admin o usuario'
        ];
    }
}
