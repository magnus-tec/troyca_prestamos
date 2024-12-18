<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAporte extends Model
{
    use HasFactory;
    protected $table = 'detalles_aportes';

    protected $fillable = [
        'aporte_id', // Relación con la tabla 'aporte_ahorros'
        'monto',
        'estado',
    ];
    public function aporteAhorro()
    {
        return $this->belongsTo(AporteAhorro::class, 'aporte_id');
    }
}
