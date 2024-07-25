<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionParticipante extends Model
{
    use HasFactory;

    protected $table = 'calificacion_participante';
    protected $primaryKey = 'cp_id';

    protected $fillable = [
        'cp_descripcion',
        'cp_puntaje',
        'pi_id',
        'pm_id',
        'cp_estado',
        'cp_calificacion',
    ];

    // Relación con el modelo ProgramaInscripcion
    public function programaInscripcion()
    {
        return $this->belongsTo(ProgramaInscripcion::class, 'pi_id');
    }

    // Relación con el modelo ProgramaModulo
    public function programaModulo()
    {
        return $this->belongsTo(ProgramaModulo::class, 'pm_id');
    }
}
