<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizaciones extends Model
{
    use HasFactory;

    protected $primaryKey = 'id'; 
    protected $table = 'tb_organizaciones'; 
    protected $fillable = [
        'nombre',
        'estado',
        'telefono',
        'correo_electronico',
        'no_de_cuenta'
    ]; 

    /**
     * Método para desactivar una organización
     */
    public function desactivar()
    {
        $this->estado = false; 
        $this->save(); 
    }
}
