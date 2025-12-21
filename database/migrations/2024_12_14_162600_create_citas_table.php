<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPaciente')->constrained('pacientes')->onDelete('cascade'); // Relación con la tabla pacientes
            $table->foreignId('idOdontologo')->constrained('odontologos')->onDelete('cascade'); // Relación con la tabla odontologo
            $table->foreignId('idServicio')->constrained('servicios')->onDelete('cascade'); // Relación con la tabla servicio
            $table->dateTime('fechaHora');
            $table->text('descripcion')->nullable(); // Mas informacion sobre la cita
            $table->string('estado')->default('pendiente'); // Estado de la cita (pendiente, completada, cancelada)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
