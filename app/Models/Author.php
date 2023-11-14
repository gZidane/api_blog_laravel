<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function articles()
    {
        // Se especifica que la clase service tiene una relacion uno a muchos con la clase client
        // lo que está entre comillas es el nombre de la tabla que tiene esta relación
        return $this->hasMany(Article::class);
    }
}
