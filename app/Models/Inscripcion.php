<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='tb_inscripcion';
    protected $fillable=[
        'id_equipo',
        'id_evento',
        'nombre',
        'edad',
        'genero',
        'telefono',
        'telefono_emergencia',
        'nombre_entrenador',
        'tarifa'
    ];
    
    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
    public function equipo()
    {
        return $this->hasMany(equipo::class);
    }
    public function evento()
    {
        return $this->hasMany(evento::class);
    }
}
