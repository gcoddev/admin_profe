<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoInscripcion extends Model
{
    use HasFactory;


    protected $table = 'evento_inscripcion';
    protected $primaryKey = 'eve_ins_id';

    protected $fillable = [
        'eve_ins_carnet_identidad',
        'eve_ins_carnet_complemento',
        'eve_ins_nombre_1',
        'eve_ins_nombre_2',
        'eve_ins_apellido_1',
        'eve_ins_apellido_2',
        'eve_ins_fecha_nacimiento',
        'eve_correo',
        'eve_celular',
        'eve_asistencia',
        'eve_ins_estado',
        'eve_id',
        'dep_id',
        'gen_id',
        'pm_id',
    ];

    // Relación con el modelo Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'eve_id');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'gen_id');
    }

    // Relación con el modelo Departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'dep_id');
    }

    // Relación con el modelo ProgramaModalidad
    public function programaModalidad()
    {
        return $this->belongsTo(ProgramaModalidad::class, 'pm_id');
    }
}
