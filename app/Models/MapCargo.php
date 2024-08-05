<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCargo extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'map_cargo';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'car_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'car_nombre',
        'car_estado',
    ];
}
