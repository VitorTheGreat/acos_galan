<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
          [
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'role' => 'common',
            'created_at' => now(),
            'updated_at' => now()
          ],
          [
            'role' => 'seller',
            'created_at' => now(),
            'updated_at' => now()
          ],
        ]);
    }
}
