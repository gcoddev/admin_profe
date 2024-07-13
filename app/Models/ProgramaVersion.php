<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaVersion extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_version';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pv_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pv_nombre',
        'pv_numero',
        'pv_estado',
    ];
}
