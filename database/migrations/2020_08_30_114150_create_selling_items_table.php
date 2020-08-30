<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantidade', 8, 2);
            $table->float('sub_total_produto', 8, 2);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->constrained();
            $table->unsignedBigInteger('sellings_id');
            $table->foreign('sellings_id')
                  ->references('id')->on('sellings')
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
        Schema::dropIfExists('selling_items');
    }
}
