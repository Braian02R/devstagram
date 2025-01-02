<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, Post $post)
    {
        //dd('Comentando...');
        //dd($post->id);
        //dd($user->username);
        // validar 
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // almacenar el resultado 
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario Realizado Correctamente'); //session en la vista blade.php
    }
}
