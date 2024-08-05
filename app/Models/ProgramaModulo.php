<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaModulo extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'programa_modulo';
    protected $primaryKey = 'pm_id';

    protected $fillable = [
        'pm_nombre',
        'pm_descripcion',
        'pm_nota_minima',
        'pm_fecha_inicio',
        'pm_fecha_fin',
        'pm_estado',
        'pro_id',
    ];

    // Relación con el modelo Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'pro_id');
    }
}
