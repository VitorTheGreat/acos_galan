<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_storage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantidade', 15);
            $table->string('quantidade_peso', 50);
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')
                  ->references('id')->on('product')
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
        Schema::dropIfExists('control_storage');
    }
}
