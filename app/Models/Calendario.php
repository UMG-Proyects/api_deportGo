<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;
    protected $table='tb_calendario';
    protected $fillable = [
        'id_arbitro',
        'id_equipo1',
        'id_equipo2',
        'id_deportes',
        'fecha',
        'hora',
        'direccion',
        'resultadoA',
        'resultadoB',
        'Cancha'
    ];
    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }

    public function arbitro()
    {
        return $this->hasMany(arbitro::class);
    }
    public function equipo()
    {
        return $this->hasMany(equipo::class);
    }
    public function deporte()
    {
        return $this->hasMany(deporte::class);
    }
}
