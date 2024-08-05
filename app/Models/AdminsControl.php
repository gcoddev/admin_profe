<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsControl extends Model
{
    use HasFactory;

    protected $table = 'admins_control';
    protected $primaryKey = 'adm_id';

    protected $fillable = [
        'adm_titulo',
        'adm_descripcion',
        'adm_tabla',
        'adm_ip',
        'adm_nombre_maquina',
    ];
}
