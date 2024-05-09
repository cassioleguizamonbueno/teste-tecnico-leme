<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosStatus extends Model
{
    protected $table = 'pedidos_status';

    use HasFactory;

    protected $fillable = [
        'descricao'
    ];
}
