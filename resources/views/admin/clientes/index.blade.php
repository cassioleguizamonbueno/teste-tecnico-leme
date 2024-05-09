@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Listagem dos clientes</h2>
            </div>
            <div style="float: right;" >
                <a class="btn btn-primary" role="button" href="{{ route('clientes.create') }}" title="Criar Cliente">Novo</i></a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<table class="table table-bordered table-responsive-lg">
    <thead>
        <th>ID</th>
        <th>nome</th>
        <th>cpf</th>
        <th>telefone</th>
        <th>Data de nascimento</th>
        <th>ativo</th>
        <th  width="280px">Ações</th>
    </thead>
    <tbody>


        @foreach($clientes->items() as $cliente)

            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ date('d/m/Y', strtotime($cliente->data_nasc)) }}</td>
                <td>{{  $cliente->ativo == 1 ? 'Ativo' : 'Inativo' }}</td>
                <td>
                    <a href="{{ route('clientes.show', $cliente->id) }}"> ir </a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}"> Editar </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-pagination
    :paginator="$clientes"
    :appends="$filters"
/>

@endsection
