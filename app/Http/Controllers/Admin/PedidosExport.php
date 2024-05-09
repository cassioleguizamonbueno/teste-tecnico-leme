<?php


namespace App\Http\Controllers\Admin;


use App\Models\Pedidos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidosExport
{
    public function collection()
    {
        return Pedidos::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Produto',
            'Valor',
            'Data'
        ];
    }
}
