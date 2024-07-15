<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'departamento';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'dep_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'dep_nombre',
        'dep_abreviacion',
        'dep_estado',
    ];
}
