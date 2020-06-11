<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('razao_social', 250)->unique();
            $table->string('email', 50)->unique();
            $table->string('cnpj', 18)->unique();
            $table->string('ie', 15)->unique();
            $table->string('telefone', 13)->nullable();
            $table->unsignedBigInteger('states_id');
            $table->foreign('states_id')
                  ->references('id')->on('states')
                  ->constrained();
            $table->string('endereco', 50);
            $table->string('bairro', 30);
            $table->string('cidade', 30);
            $table->string('cep', 30);
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
        Schema::dropIfExists('supplier');
    }
}
