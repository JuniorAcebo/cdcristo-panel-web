<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Odontologo;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitaController extends Controller
{
    
    public function index()
    {
        // Cancelar citas vencidas (pendientes y pasadas)
        Cita::where('estado', 0)
            ->where('fechaHora', '<', now())
            ->update(['estado' => 2]);

        return view('citas.index', [
            'citas'       => Cita::with(['paciente', 'odontologo'])->get(),
            'pacientes'   => Paciente::all(),
            'odontologos' => Odontologo::where('estado', 1)->get(),
            'servicios' => Servicio::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPaciente'   => 'required|exists:pacientes,id',
            'idOdontologo' => 'required|exists:odontologos,id',
            'idServicio'    => 'required|exists:servicios,id',
            'fecha'        => 'required|date',
            'hora'         => 'required|date_format:H:i',
        ]);

        Cita::create([
            'idPaciente'   => $request->idPaciente,
            'idOdontologo' => $request->idOdontologo,
            'idServicio' => $request->idServicio,
            'fechaHora'    => Carbon::parse($request->fecha.' '.$request->hora),
            'estado'       => 0,
        ]);

        return redirect()->route('citas.index')
            ->with('success', 'Cita registrada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada');
    }

    public function completar(Cita $cita)
{
    // Solo permitir completar si está pendiente
    if ($cita->estado != 0) {
        return redirect()
            ->route('citas.index')
            ->with('success', 'La cita no se puede completar.');
    }

    $cita->update([
        'estado' => 1 // Completada
    ]);

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita completada.');
}

}
