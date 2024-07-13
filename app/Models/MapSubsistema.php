<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapSubsistema extends Model
{
    use HasFactory;
    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'map_subsistema';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'sub_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'sub_nombre',
        'sub_estado',
    ];
}
