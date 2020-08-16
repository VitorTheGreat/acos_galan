<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          RolesSeeder::class,
          UsersTableSeeder::class,
          StatesSeeder::class,
          SupplierSeeder::class,
          StorageSeeder::class,
          ProductSeeder::class,
          CustomerSeeder::class
        ]);
    }
}
