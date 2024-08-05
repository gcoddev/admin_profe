<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableProfe extends Model
{
    use HasFactory;
     // Definir el nombre de la tabla si es diferente a la convención estándar
     protected $table = 'responsable_profe';

     // Definir la clave primaria si no es 'id'
     protected $primaryKey = 'resp_profe_id';

     // Permitir la asignación masiva en estos campos
     protected $fillable = [
         'resp_profe_imagen',
         'resp_profe_nombre_completo',
         'resp_profe_celular',
         'resp_profe_cargo',
         'resp_profe_facebook',
         'resp_profe_tiktok',
         'resp_profe_correo',
         'resp_profe_pagina',
         'resp_profe_youtube',
         'resp_profe_estado',
     ];
}
