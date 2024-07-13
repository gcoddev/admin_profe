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
        'ptc_ids',
        'pc_estado',
        'pro_tip_id',
    ];

    // Relación con el modelo ProgramaTipo
    public function programaTipo()
    {
        return $this->belongsTo(ProgramaTipo::class, 'pro_tip_id');
    }



}
