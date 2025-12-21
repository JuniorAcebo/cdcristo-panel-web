<?php

namespace App\Http\Controllers;


class BlogController extends Controller
{
    public function index()
    {
        return view('CristoRey.pagina.blog1');
    }
    public function index2()
    {
        return view('CristoRey.pagina.blog2');
    }
}
