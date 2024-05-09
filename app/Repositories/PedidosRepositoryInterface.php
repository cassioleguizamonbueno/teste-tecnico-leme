<?php

namespace App\Repositories;

use App\DTO\CreatePedidosDTO;
use App\DTO\UpdatePedidosDTO;

use stdClass;

interface PedidosRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreatePedidosDTO $dto): stdClass;
    public function update(UpdatePedidosDTO $dto): stdClass|null;

}
