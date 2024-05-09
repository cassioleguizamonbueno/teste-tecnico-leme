<?php

namespace App\Repositories;

use App\DTO\CreateClientesDTO;
use App\DTO\UpdateClientesDTO;

use stdClass;

interface ClientesRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreateClientesDTO $dto): stdClass;
    public function update(UpdateClientesDTO $dto): stdClass|null;

}
