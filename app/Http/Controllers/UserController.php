<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Recupera todos los usuarios
        return view('user.index', compact('users')); // Enviar usuarios a la vista
    }

    public function create()
    {
        return view('user.create');
    }


    public function store(UserRequest $request)
    {
        User::create($request->validated()); // Crea un nuevo usuario
        return redirect()->route('user.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user')); // Retorna la vista para editar el usuario
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated()); // Actualiza el usuario
        return redirect()->route('user.index')->with('success', 'Usuario editado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete(); // Elimina el usuario
        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
