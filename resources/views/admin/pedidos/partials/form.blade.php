@csrf()

    <br />
    <div class="form-group">
        <label>Produto:</label>
        <input type="text" class="form-control" placeholder="Nome do Produto" name="produto" value="{{ $pedido->produto ?? old('produto') }}" />
    </div>
    <div class="form-group">
        <label>Valor:</label>
        <input type="text" class="form-control"  name="valor" placeholder="valor" value="{{ $pedido->valor ?? old('valor') }}" onkeypress="$(this).mask('999.999.990,00', {reverse: true})" />
    </div>
    <div class="form-group">
        <label>Data:</label>
        <div class="input-group date">
            <input type="text" id="data" name="data" value="{{ isset($pedido->data) ? date('d/m/Y', strtotime($pedido->data)) : old('data') }}" class="form-control"/>
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Cliente: </label>
        <select name="cliente_id" class="form-control">
            <option value="">Selecione o cliente</option>
            @foreach( $comboClientes as $keyCliente => $cliente)
                <option value="{{ $cliente->id }}"
                    {{ (isset($pedido) && $pedido->cliente_id == $cliente->id  ? "selected" :
                        (old("cliente_id") == $cliente->id ? "selected" : "")) }} >{{ $cliente->nome }}</option>
            @endforeach
        </select>
{{--        <input type="text" class="form-control"  name="telefone" placeholder="Telefone" value="{{ $cliente->telefone ?? old('telefone') }}" />--}}
    </div>
    <div class="form-group">
        <label>Status do Pedido:</label>
        <select name="pedido_status_id" class="form-control">
            <option value="">Selecione o status do pedido</option>
            @foreach( $comboPedidoStatus as $key => $statusPedido)
                <option value="{{ $statusPedido->id }}"
                    {{ (isset($pedido) && $pedido->cliente_id == $cliente->id  ? "selected" :
                        (old("pedido_status_id") == $statusPedido->id ? "selected" : "")) }} >{{ $statusPedido->descricao }}</option>
            @endforeach
        </select>
        {{--        <input type="text" class="form-control"  name="telefone" placeholder="Telefone" value="{{ $cliente->telefone ?? old('telefone') }}" />--}}
    </div>

    <div class="form-group">
        <label>Status:</label>
        <select name="ativo" class="form-control">
            <option value="1" {{ (old("ativo") == "1" ? "selected" : "") }} {{ (old("ativo") == "1" ? "selected" : "") }} >Ativo</option>
            <option value="0" {{ (old("ativo") == "0" ? "selected" : "") }} {{ (old("ativo") == "0" ? "selected" : "") }} >Inativo</option>
        </select>
    </div>

    <div class="form-group">
        <label>Imagem:</label>
        <input type="file" name="imagem" class="form-control"/>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Enviar</button>
    </div>


