<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantesAjedrez extends Model
{
    use HasFactory;

    protected $table = 'participantes_ajedrez';
    protected $primaryKey = 'pa_id';

    protected $fillable = [
        'pi_id',
        'pa_estado',
        'cp_calificacion',
    ];

    // Relación con el modelo ProgramaInscripcion
    public function programaInscripcion()
    {
        return $this->belongsTo(ProgramaInscripcion::class, 'pi_id');
    }
}
