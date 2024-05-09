<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string("produto", 255)->nullable(false);
            $table->decimal("valor", 22)->nullable(false)->default(0.00);
            $table->dateTime('data')->nullable(false);
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('pedido_status_id');
            $table->tinyInteger('ativo')->nullable(false);
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('pedido_status_id')->references('id')->on('pedidos_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
