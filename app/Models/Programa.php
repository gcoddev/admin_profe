<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programa';
    protected $primaryKey = 'pro_id';

    protected $fillable = [
        'pro_nombre',
        'pro_nombre_abre',
        'pro_contenido',
        'pro_horario',
        'pro_carga_horaria',
        'pro_costo',
        'pro_duracion',
        'pro_banner',
        'pro_afiche',
        'pro_convocatoria',
        'pro_fecha_inicio_inscripcion',
        'pro_fecha_fin_inscripcion',
        'pro_fecha_inicio_clase',
        'pro_estado_inscripcion',
        'pro_estado',
        'pd_id',
        'pv_id',
        'pro_tip_id',
        'pm_id',
    ];

    // Definir relaciones si es necesario
    public function duracion()
    {
        return $this->belongsTo(ProgramaDuracion::class, 'pd_id');
    }

    public function version()
    {
        return $this->belongsTo(ProgramaVersion::class, 'pv_id');
    }

    public function tipo()
    {
        return $this->belongsTo(ProgramaTipo::class, 'pro_tip_id');
    }

    public function modalidad()
    {
        return $this->belongsTo(ProgramaModalidad::class, 'pm_id');
    }
}
