<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';
    protected $table = 'municipios';
    protected $fillable = [
        'municipio',
        'departamento'
    ];
    
    public function desactivar()
    {
        $this->activo = 0;
        $this->save();
    }
}
