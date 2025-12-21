<?php

namespace App\Http\Controllers;
use App\Models\Contacto;

class HomeController extends Controller
{
    public function index(){
        $mensajes = Contacto::all();
        return view('index', compact('mensajes'));
    }

    public function destroy($id)
    {
        try {
            $mensaje = Contacto::findOrFail($id);
            $mensaje->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al eliminar el mensaje: ' . $e->getMessage()
            ], 500);
        }
    }
}
