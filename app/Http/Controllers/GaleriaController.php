<?php

namespace App\Http\Controllers;


class GaleriaController extends Controller
{
    public function seguro()
    {
        return view('CristoRey.pagina.seguro'); 
    }

    public function fotos()
    {
        return view('CristoRey.pagina.galeriaFotos'); 
    }

    public function team()
    {
        return view('CristoRey.pagina.team'); 
    }

    public function about_as()
    {
        return view('CristoRey.pagina.about'); 
    }
}
