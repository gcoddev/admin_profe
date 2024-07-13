<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';
    protected $primaryKey = 'eve_id';

    protected $fillable = [
        'eve_nombre',
        'eve_descripcion',
        'eve_banner',
        'eve_afiche',
        'pm_ids',
        'eve_fecha',
        'eve_inscripcion',
        'eve_ins_hora_asis_habilitado',
        'eve_ins_hora_asis_deshabilitado',
        'eve_convocatoria',
        'eve_total_inscrito',
        'eve_estado',
        'et_id',
    ];

    // Relación con el modelo TipoEvento
    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class, 'et_id');
    }
}
