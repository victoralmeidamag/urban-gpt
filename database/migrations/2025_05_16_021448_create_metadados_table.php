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
        Schema::create('metadados', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('cidade_id');
            $table->string('chave', 255)->nullable();
            $table->longText('valor');
            
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->unique('id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadados');
    }
};
