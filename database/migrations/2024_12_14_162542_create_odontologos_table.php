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
        Schema::create('odontologos', function (Blueprint $table) {
            $table->id()->primary();
            $table->bigInteger('ci')->unique()->index();
            $table->string('nombre',100);
            $table->string('appaterno',50)->nullable();
            $table->string('telefono',15);
            $table->enum('sexo', ['M', 'F']);
            $table->foreignId('idUsuario')->constrained('users');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontologos');
    }
};
