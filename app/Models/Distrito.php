<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente a la convención estándar
    protected $table = 'distrito';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'dis_id';

    // Permitir la asignación masiva en estos campos
    protected $fillable = [
        'dis_nombre',
        'dis_codigo',
        'dis_estado',
        'dep_id',
    ];

    // Relación con el modelo TipoEvento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'dep_id');
    }

}
