@extends('layouts.app')
@section('title', 'Agendamento')
@section('content')
    <section class="page-agendamento">
        <form>
            <select name="servico">
                <option value="">Selecione um serviço</option>
            </select>
            <input type="date" name="data">
        </form>
    </section>
@endsection