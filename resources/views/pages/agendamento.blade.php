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
        @php
use Carbon\Carbon;
@endphp
        {{ Carbon::now() }}
        <h2>Proximos Agendamentos</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>id_servico</th>
                    <th>id_pet</th>
                    <th>Data agendamento</th>
                    <th>Hora agendamento</th>
                    <th>Descricao</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nextAgendamentos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->id_servico }}</td>
                    <td>{{ $item->id_pet }}</td>
                    <td>{{ $item->data_agendamento }}</td>
                    <td>{{ $item->hora_agendamento }}</td>
                    <td>{{ $item->descricao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h2 style="margin-top: 100px">Ultimos Agendamentos</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>id_servico</th>
                    <th>id_pet</th>
                    <th>Data agendamento</th>
                    <th>Hora agendamento</th>
                    <th>Descricao</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prevAgendamentos as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->id_servico }}</td>
                    <td>{{ $item->id_pet }}</td>
                    <td>{{ $item->data_agendamento }}</td>
                    <td>{{ $item->hora_agendamento }}</td>
                    <td>{{ $item->descricao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @dump($prevAgendamentos)
        @dump($nextAgendamentos)
    </section>
    <style>
        form{
            display: flex;
            flex-direction: column;
            gap: 5px;
            background: #d0d0d0
        }
        table{
            text-align: center
        }
    </style>
@endsection