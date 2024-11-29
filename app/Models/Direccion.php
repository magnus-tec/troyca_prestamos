<?php
// app/Models/Direccion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $fillable = [
        'registro_socio_id',
        'departamento',
        'provincia',
        'distrito',
        'tipo_vivienda',
        'direccion',
        'referencia',
        'telefono',
        'correo'
    ];

    public function registroSocio()
    {
        return $this->belongsTo(RegistroSocio::class);
    }

    // Método para obtener dirección completa
    public function getDireccionCompletaAttribute()
    {
        return "{$this->direccion}, {$this->distrito}, {$this->provincia}, {$this->departamento}";
    }
}