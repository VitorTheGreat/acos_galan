<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTotalQuantityView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE VIEW product_total_quantity_view AS
        SELECT SUM(cs.quantidade) as total_produtos, cs.unidade_venda, p.*, sp.razao_social as fornecedor FROM control_storages AS cs
        INNER JOIN products AS p ON p.id = cs.produto_id
        INNER JOIN suppliers AS sp ON sp.id = p.supplier_id
        GROUP BY cs.produto_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW product_total_quantity_view");
    }
}
