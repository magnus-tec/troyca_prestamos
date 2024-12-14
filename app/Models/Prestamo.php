<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_solicitud',
        'registro_socio_id',
        'producto',
        'garantia',
        'detalle_garantia',
        'fecha_desembolso',
        'dni',
        'asesor',
        'expediente',
        'estado',
    ];

    // Relación con el modelo RegistroSocio
    public function datosPersonales()
    {
        return $this->belongsTo(DatosPersonales::class, 'registro_socio_id');
    }
    public function registroSocio()
    {
        return $this->belongsTo(RegistroSocio::class);
    }
}
