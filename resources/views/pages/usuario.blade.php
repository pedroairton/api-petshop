@extends('layouts.app')
@section('titulo', 'Usuário - ' . $usuario->nome)
@section('content')
    <section class="page-usuario">
        <h2>Detalhes do usuário</h2>
        <br>
        <h3><b>Nome:</b> {{ $usuario->nome }}</h3>
        <h3><b>Endereço:</b>{{ $usuario->endereco }}</h3>
        <h3><b>Email:</b> {{ $usuario->email }}</h3>
        <h3><b>Telefone:</b> {{ $usuario->telefone }}</h3>
        <form class="form" action="">
            @csrf
            <input type="text" name="nome" placeholder="Nome do pet">
            <select name="genero">
                <option value="" disabled selected>Selecione um gênero</option>
                <option value="M">M</option>
                <option value="F">F</option>
                <option value="Outro">Outro</option>
            </select>
            <input type="date" name="data_nascimento">
            <select name="tipo_animal">
                <option value="" disabled selected>Selecione o animal</option>
                <option value="Gato">Gato</option>
                <option value="Cachorro">Cachorro</option>
                <option value="Outro">Outro</option>
            </select>
            <input type="text" name="raca" placeholder="Raça">
            <button type="submit">Enviar</button>
        </form>
        <table>
            <thead>
                <th>Nome do pet</th>
                <th>Gênero</th>
                <th>Idade</th>
                <th>Tipo</th>
                <th>Raça</th>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                    <tr>
                        <td>{{ $pet->nome }}</td>
                        <td>{{ $pet->genero }}</td>
                        <td>{{ $pet->data_nascimento }}</td>
                        <td>{{ $pet->tipo_animal }}</td>
                        <td>{{ $pet->raca }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form class="form-agendamento">
            @csrf
            <select name="id_servico">
                <option value="" selected disabled>Selecione um serviço</option>
                @foreach ($servicos as $servico)
                    <option value={{ $servico->id }}>{{ $servico->nome_servico }}</option>
                @endforeach
            </select>
            <select name="id_pet">
                <option value="" selected disabled>Selecione um pet</option>
                @foreach ($pets as $pet)
                    <option value={{ $pet->id }}>{{ $pet->nome }}</option>
                @endforeach
            </select>
            <input type="date" name="data_agendamento">
            <input type="time" name="hora_agendamento">
            {{-- <input type="datetime-local" name="" id=""> --}}
            <textarea name="descricao" placeholder="Descrição"></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>
    <style>
        form {
            background-color: #d0d0d0;
            padding: 4px;
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            gap: 5px
        }
    </style>
    <script>
        document.querySelector('.form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Pegando os dados do formulário
            const formData = new FormData(this);

            // Enviando os dados via Fetch API
            fetch('{{ route('pet', ['id' => $usuario->id]) }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        // Exibindo erros
                        document.getElementById('errors').innerHTML =
                            `<p>${data.errors.name || ''} ${data.errors.email || ''}</p>`;
                    } else {
                        alert('Formulário enviado com sucesso!');
                    }
                })
                .catch(error => console.log('Erro:', error));
        });
        document.querySelector('.form-agendamento').addEventListener('submit', function(e) {
            e.preventDefault();

            // Pegando os dados do formulário
            const formData = new FormData(this);

            // Enviando os dados via Fetch API
            fetch('{{ route("agendamento") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        // Exibindo erros
                        document.getElementById('errors').innerHTML =
                            `<p>${data.errors.name || ''} ${data.errors.email || ''}</p>`;
                    } else {
                        alert('Formulário enviado com sucesso!');
                    }
                })
                .catch(error => console.log('Erro:', error));
        });
    </script>
@endsection
