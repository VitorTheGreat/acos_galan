<?php

use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('storages')->insert([
        [
            'name' => 'Estoque 1 - Ibiúna',
            'local' => 'Ibiúna',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Estoque 2 - KM54',
            'local' => 'Ibiúna',
            'created_at' => now(),
            'updated_at' => now()
        ]
      ]);
    }
}
