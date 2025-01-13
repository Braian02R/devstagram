@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    {{-- @forelse ( $posts as $post)
        <h1>{{ $post->titulo}}</h1>
    @empty
        <p>No hay posts</p>
    @endforelse --}}

    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{route('posts.show', ['post' => $post, 'user' => $post->user])}}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="imagen del post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>

        <div class="my-10">
            {{$posts->links()}}
        </div>
    @else
        <p class="text-center">No hay posts, sigue a alguien y comienza a interactuar :)</p>
    @endif

    
@endsection
