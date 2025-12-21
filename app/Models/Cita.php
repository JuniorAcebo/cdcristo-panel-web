<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'idPaciente',
        'idOdontologo',
        'idServicio',
        'fechaHora',
        'descripcion',
        'estado',
    ];

    // 🔗 Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente');
    }

    public function odontologo()
    {
        return $this->belongsTo(Odontologo::class, 'idOdontologo');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'idServicio');
    }
}
