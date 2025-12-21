<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
     use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'ci',
        'nombre',
        'appaterno',
        'apmaterno',
        'telefono',
        'sexo',
        'seguro',
        'fechaSeAdquirido',
        'fechaSeExpiracion',
    ]; 

    protected $casts = [
        'seguro' => 'boolean',
        'fechaSeAdquirido' => 'date',
        'fechaSeExpiracion' => 'date',
    ];

    // 🔗 Relaciones
    public function citas()
    {
        return $this->hasMany(Cita::class, 'idPaciente');
    }
}
