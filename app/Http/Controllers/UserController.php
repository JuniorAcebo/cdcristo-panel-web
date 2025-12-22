<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $data = $request->validated();

        // Seguridad extra (por si acaso)
        unset($data['is_admin']);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }




    public function toggleEstado(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puedes desactivar tu propio usuario.');
        }

        $user->update([
            'estado' => !$user->estado
        ]);

        return redirect()->route('user.index')
            ->with('success',
                $user->estado
                    ? 'Usuario activado correctamente'
                    : 'Usuario desactivado correctamente'
            );
    }


}
