<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deporte extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tb_deporte';
    protected $fillable = [
        'nombre'
    ];

    public function desactivar()
    {
        $this->estado = 0;
        $this->save();
    }
}
