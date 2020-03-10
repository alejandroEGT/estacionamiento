<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Alejandro Godoy Troncozo',
            'email' => 'alejandro.e.g.t29@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
