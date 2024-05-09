@csrf()

    <br />
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" class="form-control" placeholder="Nome" name="nome" value="{{ $cliente->nome ?? old('nome') }}" />
    </div>
    <div class="form-group">
        <strong>CPF:</strong>
        <input type="text" class="form-control"  name="cpf" placeholder="cpf" value="{{ $cliente->cpf ?? old('cpf') }}" />
    </div>
    <div class="form-group">
        <strong>Data de Nascimento:</strong>
        <div class="input-group date">
            <input type="text" id="data_nasc" name="data_nasc" value="{{ isset($cliente->data_nasc) ? date('d/m/Y', strtotime($cliente->data_nasc)) : old('data_nasc') }}" class="form-control"/>
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
{{--        <input type="text" class="form-control"  name="data_nasc" placeholder="Data de Nascimento" value="{{ $cliente->data_nasc ?? old('data_nasc') }}" />--}}
    </div>
    <div class="form-group">
        <strong>Telefone:</strong>
        <input type="text" class="form-control"  name="telefone" placeholder="Telefone" value="{{ $cliente->telefone ?? old('telefone') }}" />
    </div>
    <div class="form-group">
        <strong>Status:</strong>
        <input type="text" class="form-control"  name="ativo" placeholder="ativo" value="{{ $cliente->ativo ?? old('ativo') }}" />
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Enviar</button>
    </div>


