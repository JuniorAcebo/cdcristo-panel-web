<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagenUrl',
    ];

    // 🔗 Relaciones
    public function citas()
    {
        return $this->hasMany(Cita::class, 'idServicio');
    }
}
