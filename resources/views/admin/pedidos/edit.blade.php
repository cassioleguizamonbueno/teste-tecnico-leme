@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar novo pedido</h2>
            </div>
            <div style="float:right;">
                <a class="btn btn-primary" href="{{ route('pedidos.index') }}" title="Voltar">Voltar</a>
            </div>
        </div>
    </div>

    <x-alert/>

    <form action="{{ route('pedidos.update', $pedido->id ) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.pedidos.partials.form', [
            'pedido' => $pedido
        ])
    </form>
@endsection


