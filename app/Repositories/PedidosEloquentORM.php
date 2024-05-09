<?php

namespace App\Repositories;

use App\DTO\CreatePedidosDTO;
use App\DTO\UpdatePedidosDTO;
use App\Models\Pedidos;

use stdClass;

class PedidosEloquentORM implements PedidosRepositoryInterface
{
    public function __construct(
        protected Pedidos $model
    )
    { }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where(function ($query) use ($filter){
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->paginate($totalPerPage, ["*"], 'page', $page);

        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        return $this->model
            ->where(function ($query) use ($filter){
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->get()
            ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $pedido = $this->model->find($id);
        if (!$pedido){
            return null;
        }

        return (object) $pedido->toArray();

    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function new(CreatePedidosDTO $dto): stdClass
    {
        $pedido = $this->model->create(
            (array) $dto
        );

        return (object) $pedido->toArray();
    }

    public function update(UpdatePedidosDTO $dto): stdClass|null
    {
        if (!$pedido = $this->model->find($dto->id)){
            return null;
        }

        $pedido->update(
            (array) $dto
        );
        return (object) $pedido->toArray();
    }

}
