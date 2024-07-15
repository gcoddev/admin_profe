<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaInscripcion extends Model
{
    use HasFactory;


    protected $table = 'programa_inscripcion';
    protected $primaryKey = 'pi_id';

    protected $fillable = [
        'pi_doc_digital',
        'pi_estado',
        'per_id',
        'pro_id',
        'pro_tur_id',
        'sede_id',
        'pie_id',
    ];

    // Relación con el modelo MapPersona
    public function persona()
    {
        return $this->belongsTo(MapPersona::class, 'per_id');
    }

    // Relación con el modelo Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'pro_id');
    }

    // Relación con el modelo ProgramaTurno
    public function programaTurno()
    {
        return $this->belongsTo(ProgramaTurno::class, 'pro_tur_id');
    }

    // Relación con el modelo Sede
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    // Relación con el modelo ProgramaInscripcionEstado
    public function estadoInscripcion()
    {
        return $this->belongsTo(ProgramaInscripcionEstado::class, 'pie_id');
    }
}
