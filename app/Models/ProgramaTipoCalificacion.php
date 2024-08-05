<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaTipoCalificacion extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_tipo_calificacion';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'ptc_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'ptc_nombre',
        'ptc_nota',
        'ptc_estado',
    ];
}
