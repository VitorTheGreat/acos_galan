<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
          [
            'nome' => 'Sem Cadastro',
            'email' => 'nsemcadastro@semcadastro.com',
            'cpf' => '000.000.000-00',
            'rg' => '00.000.000/0',
            'telefone' => '(99) 9 9999-9999',
            'celular' => '(99) 9 9999-9999',
            'cep' => '99999-000',
            'cidade' => 'Sem Cidade',
            'bairro' => 'Sem Bairro',
            'states_id' => 25,
            'endereco' => 'Sem Rua, 99',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'nome' => 'Vitor Hugo Lanza Costa',
            'email' => 'vitor.services@gmail.com',
            'cpf' => '436.594.988-82',
            'rg' => '38.231.278/8',
            'telefone' => '(15) 9 99854-0088',
            'celular' => '(15) 9 99854-0088',
            'cep' => '18150-000',
            'cidade' => 'Ibiúna',
            'bairro' => 'Residencial Europa',
            'states_id' => 25,
            'endereco' => 'Rua Iugoslavia, 12',
            'created_at' => now(),
            'updated_at' => now()
          ]
        ]);
    }
}
