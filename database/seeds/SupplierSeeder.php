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
        [
          'razao_social' => 'Sem Fornecedor',
          'email' => 'semfornecedor@semfornecedor.com.br',
          'cnpj' => '00.000.000/0001-00',
          'ie' => '000.000.000.000',
          'telefone' => '(99) 9999-9999',
          'states_id' => '25',
          'endereco' => 'Sem rua, 000',
          'bairro' => 'Sem Bairro',
          'cidade' => 'Sem Cidade',
          'cep' => '00000-000',
          'created_at' => now(),
          'updated_at' => now()
        ],
        [
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
        ]
      ]
      );
    }
}
