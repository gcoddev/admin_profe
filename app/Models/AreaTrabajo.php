<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaTrabajo extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'area_trabajo';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'area_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'area_nombre',
        'area_estado',
    ];
}
