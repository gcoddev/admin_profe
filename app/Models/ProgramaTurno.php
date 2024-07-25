<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaTurno extends Model
{
    use HasFactory;


    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_turno';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pro_tur_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pro_tur_nombre',
        'pro_tur_estado',
    ];
}
