<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $table = 'sede';
    protected $primaryKey = 'sede_id';

    protected $fillable = [
        'sede_imagen',
        'sede_nombre',
        'sede_descripcion',
        'sede_imagen_responsable1',
        'sede_nombre_responsable1',
        'sede_cargo_responsable1',
        'sede_imagen_responsable2',
        'sede_nombre_responsable2',
        'sede_cargo_responsable2',
        'sede_contacto_1',
        'sede_contacto_2',
        'sede_facebook',
        'sede_tiktok',
        'sede_grupo_whatsapp',
        'sede_horario',
        'sede_turno',
        'sede_ubicacion',
        'sede_latitud',
        'sede_longitud',
        'sede_estado',
        'dep_id',
    ];

    // Definir la relación con Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'dep_id');
    }
}
