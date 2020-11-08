<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductQuantityByStorageView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE VIEW product_quantity_by_storage_view AS
        SELECT p.descricao, p.id as product_id, cs.quantidade, cs.unidade_venda, st.name as estoque, st.id as storage_id FROM control_storages AS cs
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
        // DB::statement("DROP VIEW product_quantity_by_storage_view");
        Schema::dropIfExists('product_quantity_by_storage_view');
    }
}
