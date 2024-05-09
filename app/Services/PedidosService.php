<?php

namespace App\Services;

use App\DTO\CreatePedidosDTO;
use App\DTO\UpdatePedidosDTO;
use App\Repositories\PedidosRepositoryInterface;
use stdClass;

class PedidosService
{
    public function __construct(
        protected PedidosRepositoryInterface $repository
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

    public function new(CreatePedidosDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }

    public function update(UpdatePedidosDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string|int $id): void
    {
        $this->repository->delete($id);
    }

}
