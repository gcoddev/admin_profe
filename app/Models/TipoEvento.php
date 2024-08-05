<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    use HasFactory;

    protected $table = 'tipo_evento';
    protected $primaryKey = 'et_id';

    protected $fillable = [
        'et_nombre',
        'et_estado',
    ];
}
