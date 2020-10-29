<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('tabela_preco', 8, 2)->nullable();
            $table->float('valor_pago', 8, 2)->nullable();
            $table->float('valor_desconto',8, 2)->nullable();
            $table->float('preco_total_desconto', 8, 2)->nullable();
            $table->float('total', 8, 2)->nullable();
            $table->float('troco', 8, 2)->nullable();
            $table->string('status_venda', 45);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->constrained();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->constrained();
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
        Schema::dropIfExists('sellings');
    }
}
