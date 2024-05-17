<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrocinador extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tb_patrocinadores';
    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'telefono',
    ];

    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
}
