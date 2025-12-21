<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Odontologo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * Listado de citas
     */
    public function index()
    {
        // Cancelar citas vencidas
        Cita::where('estado', 0)
            ->where('fechaRegistrata', '<', now())
            ->update(['estado' => 2]);

        return view('citas.index', [
            'citas'       => Cita::with(['paciente', 'odontologo'])->get(),
            'pacientes'   => Paciente::all(),
            'odontologos' => Odontologo::where('estado', 1)->get(),
        ]);
    }

    /**
     * Guardar nueva cita
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPaciente'   => 'required|exists:pacientes,id',
            'idOdontologo' => 'required|exists:odontologos,id',
            'fecha'        => 'required|date',
            'hora'         => 'required|date_format:H:i',
        ]);

        Cita::create([
            'idPaciente'      => $request->idPaciente,
            'idOdontologo'    => $request->idOdontologo,
            'fechaRegistrata' => Carbon::parse($request->fecha.' '.$request->hora),
            'estado'          => 0,
        ]);

        return redirect()->route('citas.index')
            ->with('success', 'Cita registrada correctamente');
    }


    /**
     * Actualizar cita
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora'  => 'required|date_format:H:i',
            'estado'=> 'required|integer'
        ]);

        $cita->update([
            'fechaRegistrata' => Carbon::parse($request->fecha . ' ' . $request->hora),
            'estado'          => $request->estado
        ]);

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada');
    }

    /**
     * Eliminar cita
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada');
    }
}