<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'genero';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'gen_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'gen_nombre',
        'gen_estado',
    ];
}
