<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPersona extends Model
{
    use HasFactory;

    protected $table = 'map_persona';
    protected $primaryKey = 'per_id';

    protected $fillable = [
        'per_rda',
        'per_dgesttla',
        'per_didep',
        'per_ci',
        'per_complemento',
        'per_nombre1',
        'per_nombre2',
        'per_apellido1',
        'per_apellido2',
        'per_fecha_nacimiento',
        'per_celular',
        'per_correo',
        'per_en_funcion',
        'per_libreta_militar',
        'per_estado',
        'gen_id',
        'esp_id',
        'cat_id',
        'car_id',
        'sub_id',
        'niv_id',
        'uni_edu_id',
        'area_id',
    ];

    // Definir relaciones si es necesario
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'gen_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(MapEspecialidad::class, 'esp_id');
    }

    public function categoria()
    {
        return $this->belongsTo(MapCategoria::class, 'cat_id');
    }

    public function cargo()
    {
        return $this->belongsTo(MapCargo::class, 'car_id');
    }

    public function subsistema()
    {
        return $this->belongsTo(MapSubsistema::class, 'sub_id');
    }

    public function nivel()
    {
        return $this->belongsTo(MapNivel::class, 'niv_id');
    }

    public function areaTrabajo()
    {
        return $this->belongsTo(AreaTrabajo::class, 'area_id');
    }

}
