@extends('layouts.app')
@section('title', 'Agendamento')
@section('content')
    <section class="page-agendamento">
        <form>
            @csrf
            <select name="servico">
                <option value="">Selecione um serviço</option>
            </select>
            <input type="date" name="data">
        </form>
        @dump($agendamento)
    </section>
    <style>
        form{
            display: flex;
            flex-direction: column;
            gap: 5px;
            background: #d0d0d0
        }
    </style>
@endsection