<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSellingView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW selling_view AS
        SELECT sl.*, u.name AS vendedor, s.local as loja, c.nome, c.cpf, c.telefone, c.celular, c.bairro, c.cidade, c.cep, c.endereco, si.quantidade, si.sub_total_produto, si.preco_base, si.preco_venda_final, p.descricao, p.id as product_id, s.id as storage_id FROM sellings AS sl 
            INNER JOIN selling_items AS si ON si.sellings_id = sl.id
            INNER JOIN products AS p ON p.id = si.product_id
            INNER JOIN storages AS s ON s.id = si.storage_id
            INNER JOIN users as u ON u.id = sl.user_id
            INNER JOIN customers AS c ON c.id = sl.customer_id");
    }

    // WHERE sl.status_venda = 'venda_fechada'

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW selling_view");
        // Schema::dropIfExists('selling_view');
    }
}
