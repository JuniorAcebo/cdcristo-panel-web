<?php

namespace App\Http\Controllers;
use App\Models\Odontologo;
use App\Http\Requests\StoreOdontologoRequest;
use App\Http\Requests\UpdateOdontologoRequest;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;

class OdontologoController extends Controller
{
    public function index()
    {
        $odontologos = Odontologo::with('usuario')
            ->orderBy('id', 'desc')
            ->get();

        return view('odontologo.index', compact('odontologos'));
    }


    public function create()
    {
        // usuarios que NO están asignados a ningún odontólogo
        $usuarios = User::whereDoesntHave('odontologo')->get();

        return view('odontologo.create', compact('usuarios'));
    }


    public function store(StoreOdontologoRequest $request)
    {
        $message = '';

        try {
            DB::beginTransaction();

            // 🔹 1. Obtener datos validados
            $data = $request->validated();

            Odontologo::create($data);

            DB::commit();
            $message = 'Odontologo registrado correctamente';

        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Error al registrar al odontologo: ' . $e->getMessage();
        }

        return redirect()->route('odontologo.index')->with('success', $message);
    }

    public function edit(Odontologo $odontologo)
    {
        $usuarios = User::whereDoesntHave('odontologo')
            ->orWhere('id', $odontologo->idUsuario)
            ->get();

        return view('odontologo.edit', compact('odontologo', 'usuarios'));
    }


    public function update(UpdateOdontologoRequest $request, Odontologo $odontologo)
    {
        $message = '';
        try {
            DB::beginTransaction();

            $data = $request->validated();

            $odontologo->update($data);

            DB::commit();
            $message = 'Odontologo actualizado correctamente';
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Error al actualizar el odontologo: ' . $e->getMessage();
        }

        return redirect()->route('odontologo.index')->with('success', $message);
    }

    public function toggleEstado(Odontologo $odontologo)
    {
        $odontologo->update([
            'estado' => !$odontologo->estado
        ]);

        return redirect()
            ->route('odontologo.index')
            ->with('success', $odontologo->estado 
                ? 'Odontólogo activado correctamente'
                : 'Odontólogo dado de baja correctamente'
            );
    }

}
