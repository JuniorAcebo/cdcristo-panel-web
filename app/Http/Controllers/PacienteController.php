<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePacienteRequest;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatePacienteRequest;


class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::orderBy('id', 'desc')->get();
        return view('paciente.index', compact('pacientes'));
    }

    public function create()
    {
        return view('paciente.create');
    }

    public function store(StorePacienteRequest $request)
    {
        $message = '';

        try {
            DB::beginTransaction();

            // 🔹 1. Obtener datos validados
            $data = $request->validated();

            // 🔹 2. Normalizar seguro y fechas
            if (empty($data['seguro'])) {
                $data['seguro'] = false;
                $data['fechaSeAdquirido'] = null;
                $data['fechaSeExpiracion'] = null;
            }

            // 🔹 3. Crear paciente
            Paciente::create($data);

            DB::commit();
            $message = 'Paciente registrado correctamente';

        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Error al registrar el paciente: ' . $e->getMessage();
        }

        return redirect()->route('paciente.index')->with('success', $message);
    }


    public function edit(Paciente $paciente)
    {
        return view('paciente.edit', compact('paciente'));
    }

    public function update(UpdatePacienteRequest $request, Paciente $paciente)
{
    $message = '';
    try {
        DB::beginTransaction();

        $data = $request->validated();

        // Manejo del seguro
        if (!isset($data['seguro']) || !$data['seguro']) {
            $data['seguro'] = false;
            $data['fechaSeAdquirido'] = null;
            $data['fechaSeExpiracion'] = null;
        }

        $paciente->update($data);

        DB::commit();
        $message = 'Paciente actualizado correctamente';
    } catch (Exception $e) {
        DB::rollBack();
        $message = 'Error al actualizar el paciente: ' . $e->getMessage();
    }

    return redirect()->route('paciente.index')->with('success', $message);
}

    public function destroy(Paciente $paciente)
    {
        $message = '';
        try {
            DB::beginTransaction();
            $paciente->delete();
            DB::commit();
            $message = 'Paciente eliminado correctamente';
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Error al eliminar el paciente: ' . $e->getMessage();
        }

        return redirect()->route('paciente.index')->with('success', $message);
    }
}
