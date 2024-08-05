<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapNivel extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'map_nivel';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'niv_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'niv_nombre',
        'niv_estado',
    ];
}
