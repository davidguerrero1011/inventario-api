<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
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
    public function register(RegisterRequest $request)
    {
        $validate = $request->validated();

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