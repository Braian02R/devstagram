<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        // dd(auth()->user());
        // dd($user->username);
        //$posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        //dd($posts);

        return view('dashboard', [
            'user' => $user,
            'posts' =>$posts
        ]);
    }

    public function create()
    {
        //dd('Creando Post...');
        return view('posts.create');
    }

    public  function store(Request $request)
    {
        //dd('Creando Publicación');
        $this->validate($request,[
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' =>$request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //otra forma de crear registros en la base datos
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //otra forma de crear registros en la base datos con relaciones 
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' =>$request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'user' =>$user,
        ]);
    }

    public function destroy(Post $post)
    {
        //dd('Eliminando ', $post->id);
        // if($post->user_id === auth()->user()->id){
        //     dd('si es la misma persona: ', auth()->user()->username);       
        // } else {
        //     dd('No es la misma persona');
        // }

        $this->authorize('delete', $post);
        $post->delete();

        //eliminando la imagen
        $imagen_path = public_path('uploads/' . $post->imagen );

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
