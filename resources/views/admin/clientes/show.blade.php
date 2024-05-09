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

<h1>Detalhes do Cliente {{ $cliente->id  }}</h1>

<ul>
    <li>Nome: {{ $cliente->nome }}</li>
    <li>Cpf: {{ $cliente->cpf }}</li>
    <li>Data de Nascimento: {{ $cliente->data_nasc }}</li>
    <li>Telefone: {{ $cliente->telefone }}</li>
    <li>Ativo: {{ $cliente->ativo }}</li>
</ul>
<form action="{{ route('clientes.destroy', $cliente->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Deletar</button>
</form>
@endsection
