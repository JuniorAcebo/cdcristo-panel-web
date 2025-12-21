<?php

namespace App\Http\Controllers;
use App\Models\Servicio; 

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function __invoke()
    {
        //$servicios = Servicios::where('id','=','18')->get();
        $servicios = Servicio::all();

        return view('CristoRey.pagina.servicio',compact('servicios')); 
    }
}
