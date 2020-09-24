<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingProductInfoView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE VIEW selling_product_info_view AS
        SELECT p.id as product_id, p.descricao, cs.quantidade, cs.unidade_venda, st.name as estoque, st.id as estoque_id, p.preco_venda FROM control_storages AS cs
        INNER JOIN storages AS st ON st.id = cs.storage_id
        INNER JOIN products AS p ON p.id = cs.produto_id");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      // DB::statement("DROP VIEW selling_product_info_view");
        Schema::dropIfExists('selling_product_info_view');
    }
}
