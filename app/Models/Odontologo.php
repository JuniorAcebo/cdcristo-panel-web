<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontologo extends Model
{
    use HasFactory;

    protected $table = 'odontologos';

    protected $fillable = [
        'nombre',
        'appaterno',
        'telefono',
        'sexo',
        'idUsuario',
        'estado',
    ];

    // 🔗 Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'idOdontologo');
    }
}
