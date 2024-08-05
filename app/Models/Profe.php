<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profe extends Model
{
    use HasFactory;
    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'profe';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'profe_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'profe_imagen',
        'profe_nombre',
        'profe_descripcion',
        'profe_sobre_nosotros',
        'profe_mision',
        'profe_vision',
        'profe_actividad',
        'profe_fecha_creacion',
        'profe_correo',
        'profe_celular',
        'profe_telefono',
        'profe_pagina',
        'profe_facebook',
        'profe_tiktok',
        'profe_youtube',
        'profe_ubicacion',
        'profe_latitud',
        'profe_longitud',
        'profe_banner',
        'profe_afiche',
        'profe_convocatoria',
        'profe_estado',
    ];
}
