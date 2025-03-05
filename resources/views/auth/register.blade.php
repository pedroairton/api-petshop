@extends('layouts.app')
@section('titulo', 'Registro')
@section('content')
    <section class="page-cadastro">
        <h1>Cadastro Admin</h1>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Usuário:</label>
            <input type="text" name="usuario" required>
            @error('usuario')
                <p>{{ $message }}</p>
            @enderror

            <label>Senha:</label>
            <input type="password" name="senha" required>
            @error('senha')
                <p>{{ $message }}</p>
            @enderror

            <label>Confirme a Senha:</label>
            <input type="password" name="senha_confirmation" required>

            <button type="submit">Cadastrar</button>
        </form>
        <a href="{{ route('login') }}">Já tem conta? Faça login</a>
    </section>
    <style>
        form{
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
    </style>
@endsection
