<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;
    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'galeria';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'galeria_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'galeria_imagen',
        'galeria_estado',
    ];
}
