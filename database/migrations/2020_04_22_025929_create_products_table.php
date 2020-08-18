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
          $table->string('descricao', 150);
          $table->string('ean', 15)->unique();
          $table->float('qtd_fracionada', 8, 2)->nullable();
          $table->float('preco_unitario', 8, 2);
          $table->float('preco_compra', 8, 2);
          $table->float('preco_custo', 8, 2);
          $table->float('preco_venda', 8, 2);
          $table->float('lucro', 8, 2);
          $table->float('ipi', 8, 2);
          $table->float('icms', 8, 2);
          $table->string('ncm', 45)->unique();
          $table->string('csosn', 45)->unique();
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
