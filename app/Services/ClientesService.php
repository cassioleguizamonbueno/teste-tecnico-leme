<?php

namespace App\Services;

use App\DTO\CreateClientesDTO;
use App\DTO\UpdateClientesDTO;
use App\Repositories\ClientesRepositoryInterface;
use stdClass;

class ClientesService
{
    public function __construct(
        protected ClientesRepositoryInterface $repository
    )
    { }

    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    )
    {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    public function getAll(string $filter = null) :array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function new(CreateClientesDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateClientesDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string|int $id): void
    {
        $this->repository->delete($id);
    }

}
