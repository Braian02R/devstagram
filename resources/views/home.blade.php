@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    
    {{-- <x-listar-post>

        <x-slot:titulo>
            <header>Esto es un header</header>
        </x-slot:titulo>

        <h1>Mostrando post desde slot</h1>
    </x-listar-post> --}}

    {{-- <x-listar-post>
        <h1>Información</h1>
    </x-listar-post>

    <x-listar-post>
        <h1>Un poco mas de información</h1>
    </x-listar-post> --}}

    <x-listar-post :posts="$posts"/>
    
@endsection
