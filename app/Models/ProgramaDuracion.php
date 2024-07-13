<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaDuracion extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_duracion';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pd_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pd_nombre',
        'pd_semana',
        'pd_estado',
    ];
}
