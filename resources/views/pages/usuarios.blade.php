@extends('layouts.app')
@section('title', 'Usuários')
@section('content')
    <section class="page-usuarios">
        {{-- @dump($usuarios) --}}
        <form>
            @csrf
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="endereco" placeholder="Endereco">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="telefone" placeholder="Telefone">
            <button type="submit">Enviar</button>
        </form>
        <table>
            <thead>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>
                    Ações (id)
                </th>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->endereco }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->telefone }}</td>
                        <td>
                            {{ $usuario->id }} 
                            <a href="{{ route('pages.usuario', $usuario->id) }}">
                                cu
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Show a second modal and hide this one with the button below.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second
                        modal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Hide this modal and show the first with the button below.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to
                        first</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();

            // Pegando os dados do formulário
            const formData = new FormData(this);

            // Enviando os dados via Fetch API
            fetch('{{ route('usuarios') }}', {
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
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        input {
            border: solid 1px #606060;
        }

        button {
            background-color: #d0d0d0
        }
    </style>
@endsection
