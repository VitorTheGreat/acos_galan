<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('estoque_fornece');
            $table->integer('estoque_recebe');
            $table->unsignedBigInteger('prod_id');
            $table->foreign('prod_id')
                  ->references('id')->on('products')
                  ->constrained();
            $table->float('qtd_prod', 8, 2);
            $table->string('responsavel_retira')->nullable();
            $table->string('status_transferencia')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
