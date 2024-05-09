
@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar novo Cliente</h2>
            </div>
            <div style="float:right;">
                <a class="btn btn-primary" href="{{ route('clientes.index') }}" title="Voltar">Voltar</a>
            </div>
        </div>
    </div>

    <x-alert/>

    <form action="{{ route('clientes.store') }}" method="post">
        @include('admin.clientes.partials.form')
    </form>
@endsection

