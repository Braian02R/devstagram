<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    // otra forma de hacer lo de abajo
    // public function usuario()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    //al llamarse la funcion "user" entonces laravel busca en el modelo de User "user_id" 
    //si fuese otro nombre la funcion por ejemplo usuario buscaria "usuario_id" 
    //pero este no existe en el modelo de User.
    public function user() 
    {
        return $this->belongsTo(User::class); 
    }
}
