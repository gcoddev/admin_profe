<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapEspecialidad extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'map_especialidad';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'esp_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'esp_nombre',
        'esp_estado',
    ];
}
