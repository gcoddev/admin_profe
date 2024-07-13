<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaBaucher extends Model
{
    use HasFactory;


    protected $table = 'programa_baucher';

    // Definir la clave primaria si no es 'id'
    protected $primaryKey = 'pro_bau_id';

    protected $fillable = [
        'pro_bau_imagen',
        'pro_bau_nro_deposito',
        'pro_bau_monto',
        'pro_bau_fecha',
        'pro_bau_tipo_pago',
        'pi_id'
    ];

    // Relación con el modelo ProgramaInscripcion
    public function programaInscripcion()
    {
        return $this->belongsTo(ProgramaInscripcion::class, 'pi_id', 'pi_id');
    }
}
