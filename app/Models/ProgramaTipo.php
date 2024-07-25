<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaTipo extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'programa_tipo';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pro_tip_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'pro_tip_nombre',
        'pro_tip_estado',
    ];
}
