<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questaos', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('enunciado');
            $table->json('alternativas')->nullable();
            $table->integer('alternativa_correta');
            $table->integer('nivel');
            $table->integer('sub_categoria');
            $table->enum('status',['Pendente','Ativo','Bloqueada'])->default('Pendente');
            $table->json('aceita');
            $table->json('recusada');
            $table->integer('professor_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questaos');
    }
}
