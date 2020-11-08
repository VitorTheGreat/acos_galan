<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("CREATE VIEW product_view AS
          SELECT p.*, sp.razao_social as fornecedor FROM products AS p
          INNER JOIN suppliers AS sp ON sp.id = p.supplier_id");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      // DB::statement("DROP VIEW product_view");
      Schema::dropIfExists('product_view');
    }
}
