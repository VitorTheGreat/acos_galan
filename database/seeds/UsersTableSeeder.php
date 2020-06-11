<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Vitor',
            'email' => 'vitor@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('programador'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
