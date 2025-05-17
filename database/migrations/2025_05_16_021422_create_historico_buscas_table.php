<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('historico_buscas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('usuario_id');
            $table->integer('cidade_id');
            $table->longText('mensagem_original')->nullable();
            $table->string('resposta_gerada', 255)->nullable();
            $table->string('data_busca', 19);
            
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->unique('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_buscas');
    }
};
