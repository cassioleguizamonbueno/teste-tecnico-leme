<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateClientes;
use DateTime;
use Exception;

class CreateClientesDTO
{
    public function __construct(
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
        $date1 = date('Y-m-d', strtotime($date));

        $data_verificar = new DateTime($date1);
        $data_atual = new DateTime();

//dd($data_verificar > $data_atual, $data_verificar , $data_atual);

        if ($data_verificar > $data_atual) {
            throw new Exception("Ops! A data está no futuro.");
        }

        return new self(
            $request->nome,
            $request->cpf,
            date('Y-m-d 00:00:00', strtotime($date)),
            $request->ativo,
            $request->telefone
        );
    }

}
