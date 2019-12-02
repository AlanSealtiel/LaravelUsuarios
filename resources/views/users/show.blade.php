
@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>

    <p>Nombre del usuario: {{ $user->nom_com }}</p>
    <p>Correo electrónico: {{ $user->rfc }}</p>

    <p>
        <a href="{{url('/usuarios')}}">
            Regresar
        </a>
    </p>
@endsection