<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\OdontologoController;
use App\Http\Controllers\UserController;
use App\Models\Servicios;

// Redirigir a login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


// Rutas protegidas por middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Panel principal
    Route::get('/panel', [HomeController::class, 'index'])->name('panel');
    Route::resource('paciente', PacienteController::class);
    Route::resource('odontologo', OdontologoController::class);
    Route::patch('/odontologo/{odontologo}/estado',[OdontologoController::class, 'toggleEstado'])->name('odontologo.toggleEstado');
    Route::patch('/citas/{cita}/completar', [CitaController::class, 'completar'])->name('citas.completar');
    Route::patch('/users/{user}/toggle-estado', [UserController::class, 'toggleEstado'])->name('user.toggleEstado');


    // Rutas para citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::resource('citas', CitaController::class)->except(['show']); // Asegúrate de que el nombre sea 'cita' y no 'citas'
    Route::match(['put', 'post'], '/citas/{cita}', [CitaController::class, 'update'])->name('citas.update');

    // Rutas para usuarios
    Route::resource('user', UserController::class)->except(['show']);
});

// Rutas para errores y pruebas
Route::get('/401', fn() => view('pages.401'));
Route::get('/404', fn() => view('pages.404'));
Route::get('/500', fn() => view('pages.500'));

Route::get('/hola', [OdontologoController::class, 'index']);