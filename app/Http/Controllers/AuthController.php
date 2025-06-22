<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Registra o almacena un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validate = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role'     => ['sometimes', Rule::in(['admin', 'user'])]
        ], [
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
        ]);

        // Si el usuario esta logueado y es admin, puedo crear el usuario con el rol que desee, de lo contrario sera user
        $role = auth()->check() && auth()->user()->role === 'admin' ? $request->input('role', 'user') : 'user';
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $role,
        ]);

        return response()->json(['message' => 'User creado de manera exitosa', 'user' => $user], 201);
    }

    /**
     * Valida credenciales y loguea usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo del usuario es obligatorio para poder ingresar',
            'email.email' => 'El correo del usuario no tiene el formato adecuado',
            'password.required' => 'La contraseña del usuario es obligatoria para ingresar',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credenciales Invalidas'], 401);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    /**
     * Desloguea usuarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Usuario deslogueado, gracias por haber ingresado a nuestro sitio']);
    }
}