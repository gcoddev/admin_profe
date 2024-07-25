<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaInscripcionEstado extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_inscripcion_estado';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pie_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pie_nombre',
        'pie_estado',
    ];
}
