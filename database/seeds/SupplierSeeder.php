<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('suppliers')->insert([
          'razao_social' => 'Caleb e Renato Gráfica ME',
          'email' => 'representantes@caleberenatograficame.com.br',
          'cnpj' => '10.777.939/0001-10',
          'ie' => '576.604.719.311',
          'telefone' => '(11) 3762-2314',
          'states_id' => '25',
          'endereco' => 'Rua Alfonso Silva, 630',
          'bairro' => 'Cidade Tiradentes',
          'cidade' => 'São Paulo',
          'cep' => '08470-770',
          'created_at' => now(),
          'updated_at' => now()
      ]);
    }
}
