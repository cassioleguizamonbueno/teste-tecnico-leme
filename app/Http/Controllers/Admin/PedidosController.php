<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreatePedidosDTO;
use App\DTO\UpdatePedidosDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePedidos;
use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\PedidosStatus;
use App\Services\PedidosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;

class PedidosController extends Controller
{
    /** @var PedidosExport */
    private $pedidosExport;

    public function __construct(
        protected PedidosService $service
    )
    {
        //$this->pedidosExport = new PedidosExport();
    }

    public function exportar()
    {

        $pedidos = Pedidos::all();
        $filename = "file.csv";
        $handle = fopen($filename, 'w+');

        foreach($pedidos as $key => $pedido){
            $client = Clientes::find($pedido->cliente_id);
            fputcsv($handle, [$pedido->id, $pedido->produto, $pedido->valor, $client->nome ], ";",'"');
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->download($filename, 'file '.date("d-m-Y H:i").'.csv', $headers);
    }

    public function index(Request $request)
    {
        $pedidos = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        //dd($clientes->items());

        return view('admin/pedidos/index', compact('pedidos', 'filters'));
    }

    public function show(string $id)
    {
        if(!$pedido = $this->service->findOne($id)){
            return redirect()->back();
        }

        return view('admin/pedidos/show', compact('pedido'));

    }

    public function create()
    {
        $comboPedidoStatus = PedidosStatus::all();
        $comboClientes = Clientes::all();

        return view('admin/pedidos/create', compact('comboClientes', 'comboPedidoStatus'));
    }


    public function store(StoreUpdatePedidos $request, Pedidos $pedidos)
    {
        $pedido = $this->service->new(
            CreatePedidosDTO::makeFromRequest($request)
        );

        if(isset($request->file)) {
            $request->validate([
                'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $filenamewithextension = $request->file('imagem')->getClientOriginalName();

            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            $extension = $request->file('imagem')->getClientOriginalExtension();

            $filenametostore = $filename . '_' . time() . '.' . $extension;

            $smallthumbnail = $filename . '_small_' . time() . '_90x100.' . $extension;

            $request->file('imagem')->storeAs('public/imagens', $filenametostore);
            $request->file('imagem')->storeAs('public/imagens/thumbnail', $smallthumbnail);

            DB::table('pedidos_imagens')->insert(
                array(
                    [
                        'pedido_id' => $pedido->id,
                        'imagem' => $filenametostore,
                        'capa' => $smallthumbnail,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                )
            );
        }

        return redirect()->route('pedidos.index');
    }

    public function edit(string $id)
    {

        $comboPedidoStatus = PedidosStatus::all();
        $comboClientes = Clientes::all();

        if(!$pedido = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/pedidos.edit', compact('pedido','comboClientes', 'comboPedidoStatus' ));
    }

    // Request trocou para StoreUpdateClientes
    public function update(StoreUpdatePedidos $request, Pedidos $pedido, string|int $id)
    {

        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filenamewithextension = $request->file('imagem')->getClientOriginalName();

        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        $extension = $request->file('imagem')->getClientOriginalExtension();

        $filenametostore = $filename.'_'.time().'.'.$extension;

        $smallthumbnail = $filename.'_small_'.time().'_90x100.'.$extension;

        $request->file('imagem')->storeAs('public/imagens', $filenametostore);
        $request->file('imagem')->storeAs('public/imagens/thumbnail', $smallthumbnail);

        $pedido = $this->service->update(
            UpdatePedidosDTO::makeFromRequest($request)
        );

        DB::table('pedidos_imagens')->insert(
            array(
                [
                    'pedido_id' => $pedido->id,
                    'imagem' => $filenametostore,
                    'capa' => $smallthumbnail,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            )
        );

        if(!$pedido) {
            return back();
        }

        return redirect()->route('pedidos.index');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('pedidos.index');

    }
}
