@extends('layouts.app')
@section('title', 'Cadastro usuário')
@section('content')
    <section class="page-cadastro">
        <h1>Cadastro de Usuário</h1>
        <br>
        <form action="{{ route('pages.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            {{ $errors->any() }}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <input type="text" placeholder="Nome" name="nome" value="{{ old('nome') }}">
            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
            <input type="text" placeholder="CPF" name="cpf" value="{{ old('cpf') }}">
            <button type="submit">Enviar</button>
        </form>
    </section>
    <style>
        input[type=text], input[type=email]{
            border: solid 1px #f0f0f0;
            padding: 5px;
        }
        button[type=submit]{
            background-color: #b0b0b0
        }
    </style>
@endsection