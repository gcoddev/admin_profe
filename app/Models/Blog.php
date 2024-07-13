<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

     // Definir el nombre de la tabla si es diferente a la convención estándar
     protected $table = 'blog';

     // Definir la clave primaria si no es 'id'
     protected $primaryKey = 'blog_id';

     // Permitir la asignación masiva en estos campos
     protected $fillable = [
         'blog_imagen',
         'blog_titulo',
         'blog_descripcion',
         'blog_estado',
     ];
}
