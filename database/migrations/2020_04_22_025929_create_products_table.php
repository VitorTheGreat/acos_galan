<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products', function (Blueprint $table) {
          $table->bigIncrements('id')->unique();
          $table->string('unidade_venda', 10);
          $table->string('descricao', 150);
          $table->float('peso', 8, 2);
          $table->float('preco_peso', 8, 2);
          $table->float('preco_compra', 8, 2);
          $table->float('preco_custo', 8, 2);
          $table->float('preco_venda', 8, 2);
          $table->float('lucro', 8, 2);
          $table->string('ipi', 45);
          $table->string('icms', 45);
          $table->string('ncm', 45);
          $table->string('csosn', 45);
          $table->unsignedBigInteger('supplier_id');
          $table->foreign('supplier_id')
                ->references('id')->on('suppliers')
                ->constrained();
          $table->unsignedBigInteger('storage_id');
          $table->foreign('storage_id')
                ->references('id')->on('storages')
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
        Schema::dropIfExists('products');
    }
}
