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
        Schema::create('contasefi', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('certificado');
            $table->string('chave_pix');
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
        Schema::dropIfExists('contasefi');
    }
};
