<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('control_storages', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->float('quantidade');
          $table->string('unidade_venda', 10);
          $table->unsignedBigInteger('produto_id');
          $table->foreign('produto_id')
                ->references('id')->on('products')
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
        Schema::dropIfExists('control_storages');
    }
}
