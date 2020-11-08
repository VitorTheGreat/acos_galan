<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransfersView extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement("CREATE VIEW transfers_view AS
                    SELECT t.id, t.updated_at, t.estoque_fornece, st.name AS estoque_a_fornecer, t.estoque_recebe, st2.name AS estoque_a_receber, p.descricao, t.qtd_prod AS quantidade, t.responsavel_retira, t.responsavel_entrega, t.status_transferencia
                    FROM transfers AS t
                    INNER JOIN products AS p ON p.id = t.prod_id
                    INNER JOIN storages AS st ON st.id = t.estoque_fornece
                    INNER JOIN storages AS st2 ON st2.id = t.estoque_recebe");
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement("DROP VIEW transfers_view");
      // Schema::dropIfExists('transfers_view');
  }
}
