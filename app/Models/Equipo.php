<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='tb_equipo';
    protected $fillable=[
        'id_deporte',
        'id_categoria',
        'id_municipio',
        'nombre',
        'participantes'
    ];
    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
    public function municipio()
    {
        return $this->hasMany(municipio::class);
    }
    public function deporte()
    {
        return $this->hasMany(deporte::class);
    }
    public function categoria()
    {
        return $this->hasMany(categoria::class);
    }
}
