<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
          'descricao' => "Tubo 20x20x1,25 gv",
          'ean' => '12345678910123',
          'qtd_fracionada' => 3.5,
          'preco_unitario' => 5.8,
          'preco_compra' => 20.3,
          'preco_custo' => 24.36,
          'preco_venda' => 36.54,
          'lucro' => 50,
          'ipi' => 10,
          'icms' => 10,
          'ncm' => '5456484',
          'csosn' => '54894654',
          'supplier_id' => 1,
          'created_at' => now(),
          'updated_at' => now()
        ]);

        DB::table('control_storages')->insert([
          [
            'quantidade' => 7,
            'unidade_venda' => 'br',
            'produto_id' => 1,
            'storage_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'quantidade' => 5,
            'unidade_venda' => 'br',
            'produto_id' => 1,
            'storage_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
