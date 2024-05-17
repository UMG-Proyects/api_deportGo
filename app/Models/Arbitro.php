<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='tb_arbitros';
    protected $fillable=[
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'direccion',
        'telefono',
        'genero'
    ];
    
    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
}

