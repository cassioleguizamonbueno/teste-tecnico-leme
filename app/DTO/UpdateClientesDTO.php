<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateClientes;

class UpdateClientesDTO
{
    public function __construct(
        public string $id,
        public string $nome,
        public string $cpf,
        public string $data_nasc,
        public string $ativo,
        public string $telefone
    )
    {
    }

    public static function makeFromRequest(StoreUpdateClientes $request): self
    {

        $date = str_replace('/', '-', $request->data_nasc);

        return new self(
            $request->id,
            $request->nome,
            $request->cpf,
            date('Y-m-d 00:00:00', strtotime($date)),
            $request->ativo,
            $request->telefone
        );
    }

}
