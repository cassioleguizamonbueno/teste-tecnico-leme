<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos_status', function (Blueprint $table) {
            $table->id();
            $table->string("descricao", 255)->nullable(true);
            $table->timestamps();
        });

        DB::table('pedidos_status')->insert(
            array(
                [
                    'descricao' => 'Solicitado',
                    'created_at' => now()
                ],
                [
                    'descricao' => 'Concluído',
                    'created_at' => now()
                ],
                [
                    'descricao' => 'Cancelado',
                    'created_at' => now()
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
