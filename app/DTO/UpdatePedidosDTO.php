<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdatePedidos;

class UpdatePedidosDTO
{
    public function __construct(
        public string $id,
        public string $produto,
        public string $valor,
        public string $data,
        public string $cliente_id,
        public string $pedido_status_id,
        public string $ativo
    )
    {
    }

    public static function makeFromRequest(StoreUpdatePedidos $request): self
    {

        $date = str_replace('/', '-', $request->data);
        $valor = str_replace('.', '', $request->valor);
        $valor = str_replace(',', '.', $valor);

        return new self(
            $request->id,
            $request->produto,
            $valor,
            date('Y-m-d 00:00:00', strtotime($date)),
            $request->cliente_id,
            $request->pedido_status_id,
            $request->ativo
        );
    }

}
