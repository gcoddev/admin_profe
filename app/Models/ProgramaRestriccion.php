<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaRestriccion extends Model
{
    use HasFactory;

    protected $table = 'programa_restriccion';
    protected $primaryKey = 'pr_id';

    protected $fillable = [
        'gen_ids',
        'sub_ids',
        'niv_ids',
        'esp_ids',
        'esp_nombres',
        'cat_ids',
        'car_ids',
        'car_nombres',
        'pr_estado',
        'pro_id',
    ];

    // Relación con el modelo Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'pro_id');
    }
}
