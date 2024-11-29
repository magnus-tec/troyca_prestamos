<?php
// app/Models/RegistroSocio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSocio extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_socio',
        'estado'
    ];

    // Relaciones
    public function datosPersonales()
    {
        return $this->hasOne(DatosPersonales::class);
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class);
    }

    public function informacionLaboral()
    {
        return $this->hasOne(InformacionLaboral::class);
    }

    public function conyuge()
    {
        return $this->hasOne(Conyuge::class);
    }

    public function beneficiarios()
    {
        return $this->hasMany(Beneficiario::class);
    }

    // Método para generar número de socio automáticamente
    public static function generarNumeroSocio()
    {
        $ultimoSocio = self::latest()->first();
        $numero = $ultimoSocio ? intval(substr($ultimoSocio->numero_socio, 3)) + 1 : 1;
        return 'SOC' . str_pad($numero, 6, '0', STR_PAD_LEFT);
    }

    // Scope para socios activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    // Método para verificar si el socio está activo
    public function estaActivo()
    {
        return $this->estado === 'activo';
    }
}