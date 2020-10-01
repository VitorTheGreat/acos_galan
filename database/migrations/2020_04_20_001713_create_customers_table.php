<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('nome', 45);
            $table->string('email', 50)->nullable();
            $table->string('cpf', 50)->unique();
            $table->string('rg', 50)->nullable();
            $table->string('telefone', 17)->nullable();
            $table->string('celular', 17)->nullable();
            $table->string('cep');
            $table->string('cidade');
            $table->string('bairro');
            $table->unsignedBigInteger('states_id');
            $table->foreign('states_id')
                  ->references('id')->on('states')
                  ->constrained();
            $table->string('endereco', 100);
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
        Schema::dropIfExists('customers');
    }
}
