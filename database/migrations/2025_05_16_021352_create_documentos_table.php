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
        Schema::create('documentos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('cidade_id');
            $table->string('titulo', 255);
            $table->string('tipo', 10);
            $table->string('url', 255);
            $table->string('path_arquivo_local', 255);
            $table->string('criado_em', 19);
            
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->unique('id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
