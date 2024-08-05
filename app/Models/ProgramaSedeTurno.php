<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaSedeTurno extends Model
{
    use HasFactory;

    protected $table = 'programa_sede_turno';
    protected $primaryKey = 'psp_id';

    protected $fillable = [
        'pro_tur_ids',
        'pro_cupo',
        'pro_cupo_preinscrito',
        'pst_estado',
        'sede_id',
        'pro_id',
    ];

    // Relación con el modelo Sede
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    // Relación con el modelo Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'pro_id');
    }
}
