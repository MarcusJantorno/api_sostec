<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->unsigned()->references('id')->on('clientes')->onDelete('cascade');
            $table->longText('logradouro');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->unsignedBigInteger('cartao_id')->unsigned();
            $table->date('data_instalacao');
            $table->unsignedBigInteger('contratoempresa_id')->unsigned();
            $table->unsignedBigInteger('aparelho_id')->unsigned();
            $table->longText('numero_serie');
            $table->integer('dia_vencimento');
            $table->date('data_vencimento');
            $table->integer('valor');
            $table->longText('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
};
