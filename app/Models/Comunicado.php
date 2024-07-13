<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;
    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'comunicado';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'comun_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'comun_imagen',
        'comun_nombre',
        'comun_descripcion',
        'comun_importancia',
        'comun_estado',
    ];
}
