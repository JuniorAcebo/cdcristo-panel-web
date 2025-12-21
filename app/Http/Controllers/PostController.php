<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index(){
        return "Soy Junior";
    }

    public function mensaje(){
        return "Esto es un mensaje";
    }

    public function casa() {
        return "Esto es una Casa";
    }
}
