@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ 
                    $user->imagen ? 
                    asset('perfiles') . '/' . $user->imagen :
                    asset('img/usuario.svg') }}" 
                    alt="imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">

                <div class="flex gap-2 items-center">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    
                    @auth
                        @if ( $user->id === auth()->user()->id )
                            <a 
                                class="text-gray-500 hover:text-gray-600 cursor-pointer" 
                                href="{{route('perfil.index')}}"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 
                                    0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 
                                    0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers->count()}}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id )
                        @if ( !$user->siguiendo( auth()->user() ))
                            <form 
                                action="{{route('users.follow', $user)}}" 
                                method="post"
                            >
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1
                                    mb-2 text-sm font-bold cursor-pointer"
                                    value="Seguir"
                                />
                            </form>
                        @else    
                            <form 
                                action="{{route('users.unfollow', $user)}}" 
                                method="post"
                            >
                                @method('DELETE')
                                @csrf
                                <input
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1
                                    text-sm font-bold cursor-pointer"
                                    value="Dejar de Seguir"
                                />
                            </form>
                        @endif
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        {{-- {{dd($posts)}} --}}

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
            <p class="text-center text-gray-600 uppercase text-sm font-bold">No hay publicaciones aún.</p>
        @endif
    </section>


@endsection