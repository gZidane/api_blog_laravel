<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function author()
    {
        // Se especifica que la clase Article tiene una relacion con la clase Service
        // lo que está entre comillas es el nombre de la tabla que tiene esta relación
        return $this->belongsTo(Author::class);
    }
}
