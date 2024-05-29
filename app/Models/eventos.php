<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='tb_eventos';
    protected $fillable = [
        'id_categoria',
        'id_deporte',
        'id_patrocinador',
        'id_municipio',
        'participantes',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_final',
        'equipos_participantes',
        'rama'
    ]; 
    
    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
    
    public function categoria()
    {
        return $this->hasMany(categoria::class);
    }
    public function deporte()
    {
        return $this->hasMany(deporte::class);
    }
    public function patrocinador()
    {
        return $this->hasMany(patrocinador::class);
    }
    public function municipio()
    {
        return $this->hasMany(municipio::class);
    }
}
