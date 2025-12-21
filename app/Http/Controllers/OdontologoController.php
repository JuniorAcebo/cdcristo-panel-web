<?php

namespace App\Http\Controllers;
use App\Models\Odontologo;
use App\Http\Requests\StoreOdontologoRequest;
use App\Http\Requests\UpdateOdontologoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Exception;

class OdontologoController extends Controller
{
    public function index()
    {
        $odontologos = Odontologo::orderBy('id', 'desc')->get();
        return view('odontologo.index', compact('odontologos'));
    }

    public function create()
    {
        return view('odontologo.create');
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
        return view('odontologo.edit', compact('odontologo'));
    }

    public function update(UpdateOdontologoRequest $request, Odontologo $odontologo)
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

            $odontologo->update($data);

            DB::commit();
            $message = 'Odontologo actualizado correctamente';
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'Error al actualizar el odontologo: ' . $e->getMessage();
        }

        return redirect()->route('odontologo.index')->with('success', $message);
    }
}
