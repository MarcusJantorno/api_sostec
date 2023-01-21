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
        Schema::create('contratoempresa', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('titular');
            $table->string('cpf');
            $table->integer('vencimento');
            $table->integer('quantidade_pontos');
            $table->string('valor_ponto');
            $table->string('cep');
            $table->longText('logradouro');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('telefone');
            $table->string('email');
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
        Schema::dropIfExists('contratoempresa');
    }
};
