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
         Schema::create('pacientes', function (Blueprint $table) {
             $table->id()->primary();
             $table->bigInteger('ci')->unique()->index();
             $table->string('nombre', 100);
             $table->string('appaterno', 50)->nullable();
             $table->string('apmaterno', 50)->nullable();
             $table->string('telefono', 15)->nullable();
             $table->enum('sexo', ['M', 'F']);
             $table->boolean('seguro')->default(false);
             $table->date('fechaSeAdquirido')->nullable();
             $table->date('fechaSeExpiracion')->nullable();
             $table->timestamps();

             $table->index(['nombre', 'appaterno', 'apmaterno']);
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
