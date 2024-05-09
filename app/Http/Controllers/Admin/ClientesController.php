<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateClientesDTO;
use App\DTO\UpdateClientesDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClientes;
use App\Models\Clientes;
use App\Services\ClientesService;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function __construct(
        protected ClientesService $service
    )
    {
    }

    public function index(Request $request)
    {
        $clientes = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        //dd($clientes->items());

        return view('admin/clientes/index', compact('clientes', 'filters'));
    }

    public function show(string $id)
    {
        if(!$cliente = $this->service->findOne($id)){
            return redirect()->back();
        }

        return view('admin/clientes/show', compact('cliente'));

    }

    public function create()
    {
        return view('admin/clientes/create');
    }


    public function store(StoreUpdateClientes $request, Clientes $clientes)
    {
        $this->service->new(
            CreateClientesDTO::makeFromRequest($request)
        );

        return redirect()->route('clientes.index');
    }

    public function edit(string $id)
    {
        if(!$cliente = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/clientes.edit', compact('cliente'));
    }

    // Request trocou para StoreUpdateClientes
    public function update(StoreUpdateClientes $request, Clientes $cliente, string|int $id)
    {
        $cliente = $this->service->update(
            UpdateClientesDTO::makeFromRequest($request)
        );

        if(!$cliente) {
            return back();
        }

        return redirect()->route('clientes.index');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('clientes.index');

    }
}
