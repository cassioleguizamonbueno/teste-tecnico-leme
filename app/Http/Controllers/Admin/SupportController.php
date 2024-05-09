<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    )
    { }

    public function index(Request $request)
    {
        //$supports = Support::all();
        // $support = new Support();

       // $supports = $support->all();
//        $supports = $this->service->getAll($request->filter);
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

       // dd($supports->items());


//        return view('admin/supports/index', [
//            'supports' => $supports
//        ]);
        /*ou*/
        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string $id)
    {
//        Support::find($id);
//        Support::where('id',  $id)->fisrt();
//        Support::where('id', '=',  $id)->fisrt();

        if(!$support = $this->service->findOne($id)){
            return redirect()->back(); // ou somente back()
        }

        // dd($support);
        return view('admin/supports/show', compact('support'));


    }

    public function create()
    {
        return view('admin/supports/create');
    }

//    public function store(Request $request, Support $support)
//    {
//        // dd($request->all());
//        $data = $request->all();
//        $data['status'] = 'a';
//        $support = $support->create($data);
//
//        // dd($support);
//       // Support::create($data);
//
//
//        return redirect()->route('supports.index');
//    }
    public function store(StoreUpdateSupport $request, Support $support)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

//        // dd($request->all());
//        //$data = $request->all();
//        $data = $request->validated();
//        $data['status'] = 'a';
//        $support = $support->create($data);
//
//        // dd($support);
//        // Support::create($data);


        return redirect()->route('supports.index');
    }

    public function edit(string $id)
    {
       // if(!$support = $support->where('id', $id)->first()) {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin/supports.edit', compact('support'));
    }

    // Request trocou para StoreUpdateSupport
    public function update(StoreUpdateSupport $request, Support $support, string|int $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if(!$support) {
            return back();
        }

//        // somente update para os campos abaixo, senão precisamos definir os filtros na model
//        $support->update($request->only(
//            [
//                'subject', 'body'
//            ]
//        ));

        /*
         * ou assim para salvar
         *
         */
        //assim tanto para salvar quanto para atualizar
        /*
        $support->subject = $request->subject;
        $support->body = $request->body;
        $support->save();
        */

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');

    }

}
