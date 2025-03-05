@extends('layouts.app')
@section('titulo', "Usuário - ". $user->name)
@section('content')
    <section>
        <h1>Mostrar Usuário: {{ $user->name }}</h1>
        @dump($user)
    </section>
@endsection
