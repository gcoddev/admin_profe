<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaModalidad extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_modalidad';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pm_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pm_nombre',
        'pm_estado',
    ];
}
