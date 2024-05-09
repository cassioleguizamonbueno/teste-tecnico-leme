@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Detalhes do pedido</h2>
            </div>
            <div style="float: right;" >
                <a class="btn btn-primary" role="button" href="{{ route('pedidos.create') }}" title="Criar Pedido">Novo</i></a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <h1>Detalhes do Pedido {{ $pedido->id  }}</h1>

    <ul>
        <li>Produto: {{ $pedido->produto }}</li>
        <li>Valor: {{ $pedido->valor }}</li>
        <li>Data: {{ $pedido->data }}</li>
        <li>Cliente: {{ $pedido->cliente_id }}</li>
        <li>Status Pedido: {{ $pedido->pedido_status_id }}</li>
        <li>Ativo: {{ $pedido->ativo }}</li>
    </ul>
    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>

@endsection
