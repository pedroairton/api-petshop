@extends('layouts.app')
@section('titulo', 'Login')
@section('content')
    <section class="page-login">
        <h2>Login de admin</h2>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Usuário:</label>
            <input type="text" name="usuario" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </section>
@endsection
