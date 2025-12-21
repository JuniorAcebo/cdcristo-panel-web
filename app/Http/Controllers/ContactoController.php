<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contacto;

use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function index()
    {
        return view('CristoRey.pagina.contacto');
    }

    public function guardar(Request $datos){

        $mensaje = new Contacto();
        $Validacion = Validator::make($datos->all(),
       [
            'nombre'=> 'required | string | regex:/^[\p{L} ]+$/u|max:255',
            'email' => 'required | email',
            'phone' => 'required|numeric|digits:8',
            'asunto' => 'required',
            'mensaje' => 'required'
       ]);

       if($datos->ajax()){
            if($Validacion->fails()){
                return response()->json(['error'=>$Validacion->errors()]);
            }

            $mensaje->nombre =ucfirst(strtolower($datos->nombre));
            $mensaje->email = $datos->email;
            $mensaje->telefono = $datos->phone;
            $mensaje->tipoasunto = $datos->asunto;
            $mensaje->mensaje = ucfirst(strtolower($datos->mensaje));

            if($mensaje->save()){
                return response()->json(['response'=>"Mensaje registrado con exito"]);
            }
            return response()->json(['response'=>"Error al registrar el mensaje"]);
       }
       else{
        if($Validacion->fails()){
            return back()->withErrors($Validacion)->withInput();
        }
            $mensaje->nombre =ucfirst(strtolower($datos->nombre));
            $mensaje->email = $datos->email;
            $mensaje->telefono = $datos->phone;
            $mensaje->tipoasunto = $datos->asunto;
            $mensaje->mensaje = ucfirst(strtolower($datos->mensaje));

            if($mensaje->save()){
                return back()->with("success","Mensaje Registrado");
            }
            return back()->with("error","Error al Registrar el Mensaje");
       }
    }
}
