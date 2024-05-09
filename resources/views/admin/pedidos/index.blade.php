@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Listagem dos pedidos</h2>
            </div>
            <div style="float: right;" >
                <a class="btn btn-primary" role="button" href="{{ route('pedidos.create') }}" title="Criar Pedido">Novo Pedido</i></a>
                <a href="{{ route('pedidos.exportar') }}" class="btn btn-second">Exportar para CSV</a>
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
        <th>produto</th>
        <th>valor</th>
        <th>data</th>
        <th>cliente</th>
        <th>status pedido</th>
        <th>ativo</th>
        <th  width="280px">Ações</th>
    </thead>
    <tbody>


        @foreach($pedidos->items() as $pedido)

            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->produto }}</td>
                <td>{{ $pedido->valor }}</td>
                <td>{{ date('d/m/Y', strtotime($pedido->data)) }}</td>
                <td>{{ \App\Models\Clientes::find($pedido->cliente_id)->nome }}</td>
                <td>{{ \App\Models\PedidosStatus::find($pedido->pedido_status_id)->descricao }}</td>
                <td>{{  $pedido->ativo == 1 ? 'Ativo' : 'Inativo' }}</td>
                <td>
                    <a href="{{ route('pedidos.show', $pedido->id) }}"> ir </a>
                    <a href="{{ route('pedidos.edit', $pedido->id) }}"> Editar </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-pagination
    :paginator="$pedidos"
    :appends="$filters"
/>

@endsection
