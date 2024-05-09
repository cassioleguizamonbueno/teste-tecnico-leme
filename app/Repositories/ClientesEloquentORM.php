<?php

namespace App\Repositories;

use App\DTO\CreateClientesDTO;
use App\DTO\UpdateClientesDTO;
use App\Models\Clientes;

use stdClass;

class ClientesEloquentORM implements ClientesRepositoryInterface
{
    public function __construct(
        protected Clientes $model
    )
    { }

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            //->where('subject', $filter)
            ->where(function ($query) use ($filter){
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like', "%{$filter}%");
                }
            })
            ->paginate($totalPerPage, ["*"], 'page', $page);
            //->toSql()
            //->toArray();

        //dd($result);
        //dd((new PaginationPresenter($result))->items());
        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array
    {
        // dd($this->model->all());
        //return $this->model->all()->toArray();
        return $this->model
                        //->where('subject', $filter)
                        ->where(function ($query) use ($filter){
                            if ($filter) {
                                $query->where('subject', $filter);
                                $query->orWhere('body', 'like', "%{$filter}%");
                            }
                        })
                        ->get()
                        //->paginate()
                        //->toSql()
                        ->toArray();

    }

    public function findOne(string $id): stdClass|null
    {
        $cliente = $this->model->find($id);
        if (!$cliente){
            return null;
        }

        return (object) $cliente->toArray();

    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function new(CreateClientesDTO $dto): stdClass
    {
        $cliente = $this->model->create(
            (array) $dto
        );

        return (object) $cliente->toArray();
    }

    public function update(UpdateClientesDTO $dto): stdClass|null
    {
        if (!$cliente = $this->model->find($dto->id)){
            return null;
        }

        $cliente->update(
            (array) $dto
        );
        return (object) $cliente->toArray();
    }

}
