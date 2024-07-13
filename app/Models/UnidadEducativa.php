<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AreaTrabajo;
use App\Models\Departamento;
class UnidadEducativa extends Model
{
    use HasFactory;

    protected $table = 'unidad_educativa';
    protected $primaryKey = 'uni_edu_id';

    protected $fillable = [
        'uni_edu_codigo',
        'uni_edu_nombre',
        'uni_edu_estado',
    ];

}
