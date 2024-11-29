<?php
// app/Models/DatosPersonales.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosPersonales extends Model
{
    use HasFactory;

    protected $fillable = [
        'registro_socio_id',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'dni',
        'fecha_nacimiento',
        'estado_civil',
        'profesion_ocupacion',
        'nacionalidad',
        'sexo'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];

    public function registroSocio()
    {
        return $this->belongsTo(RegistroSocio::class);
    }

    // Método para obtener nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->apellido_paterno} {$this->apellido_materno}, {$this->nombres}";
    }
}