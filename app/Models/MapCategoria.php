<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCategoria extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'map_categoria';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'cat_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'cat_nombre',
        'cat_estado',
    ];
}
