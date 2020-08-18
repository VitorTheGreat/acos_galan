<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        SELECT cs.quantidade, cs.unidade_venda, p.*, sp.razao_social as fornecedor, st.name as estoque FROM control_storages AS cs
        INNER JOIN products AS p ON p.id = cs.produto_id
        INNER JOIN suppliers AS sp ON sp.id = p.supplier_id
        INNER JOIN storages AS st ON st.id = p.storage_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("DROP VIEW IF EXISTS product_view");
    }
}
