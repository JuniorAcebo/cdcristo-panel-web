<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = new Servicio ();
        $servicio->nombre = 'Endodoncia';
        $servicio->descripcion = 'Salva un diente infectado y previene la pérdida dental.';
        $servicio->precio = 150.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Endodoncia.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Extracción de caries';
        $servicio->descripcion = 'Eliminar tejido dañado es crucial para evitar problemas mayores.';
        $servicio->precio = 70.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Caries.jpg';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Extracción de terceros molares';
        $servicio->descripcion = 'Elimina muelas del juicio.';
        $servicio->precio = 150.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Extraccion.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Restauración de caries';
        $servicio->descripcion = 'Repara dientes dañados, evitando su pérdida.';
        $servicio->precio = 80.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Caries.jpg';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Limpieza dental';
        $servicio->descripcion = 'Elimina placa y sarro, previniendo caries y enfermedades.';
        $servicio->precio = 50.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Limpieza dental.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Ortodoncia';
        $servicio->descripcion = 'Corrige problemas de alineación que pueden afectar la salud dental.';
        $servicio->precio = 300;
        $servicio->imagenUrl = 'img/iconos-dentista/Ortodoncia.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Coronas';
        $servicio->descripcion = 'Protegen dientes debilitados y restauran su función.';
        $servicio->precio = 180.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Corona.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Puentes';
        $servicio->descripcion = 'Rellenan espacios de dientes faltantes.';
        $servicio->precio = 200.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Puente.jpg';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Prótesis fija';
        $servicio->descripcion = 'Soluciones permanentes para reemplazar dientes perdidos.';
        $servicio->precio = 300.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Protesis fija.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Prótesis removible';
        $servicio->descripcion = 'Dentaduras que se pueden quitar y poner fácilmente.';
        $servicio->precio = 250.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Protesis removible.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Perno colado';
        $servicio->descripcion = 'Refuerza dientes tratados para mejor retención.';
        $servicio->precio = 120.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Pernos.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Perno fijo';
        $servicio->descripcion = 'Proporciona soporte a restauraciones dentales.';
        $servicio->precio = 100.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Pernos.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Prótesis de acrílico';
        $servicio->descripcion = 'Reemplazo dental accesible y ligero y accesible, ideal para dientes perdidos.';
        $servicio->precio = 220.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Protesis fija.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Prótesis de cromo cobalto';
        $servicio->descripcion = 'Prótesis metálicas resistentes para dientes perdidos.';
        $servicio->precio = 250.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Protesis covalto.jpg';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Prótesis flexible';
        $servicio->descripcion = 'Se adapta cómodamente, ofrece mayor confort y estética.';
        $servicio->precio = 270.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Flexible.png';
        $servicio->save();

        $servicio = new Servicio ();
        $servicio->nombre = 'Blanqueamiento dental';
        $servicio->descripcion = 'Aclara el color de los dientes para mejorar la estética.';
        $servicio->precio = 100.00;
        $servicio->imagenUrl = 'img/iconos-dentista/Blanqueamiento dental.png';
        $servicio->save();

    }
}
