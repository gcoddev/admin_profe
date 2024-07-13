<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'provincia';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'prov_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'prov_nombre',
        'prov_estado',
    ];
}
