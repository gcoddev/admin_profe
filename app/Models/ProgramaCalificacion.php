<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaCalificacion extends Model
{
    use HasFactory;


    protected $table = 'programa_calificacion';
    protected $primaryKey = 'pc_id';

    protected $fillable = [
<<<<<<< HEAD
        'pc_id',
        'pc_estado',
        'pro_tip_id',
        'ptc_id',
=======
        'ptc_ids',
        'pc_estado',
        'pro_tip_id',
>>>>>>> 278a853 (first commit)
    ];

    // Relación con el modelo ProgramaTipo
    public function programaTipo()
    {
        return $this->belongsTo(ProgramaTipo::class, 'pro_tip_id');
    }
<<<<<<< HEAD
    public function programaTipoCalificacion()
    {
        return $this->belongsTo(ProgramaTipoCalificacion::class, 'ptc_id');
    }
=======



>>>>>>> 278a853 (first commit)
}
