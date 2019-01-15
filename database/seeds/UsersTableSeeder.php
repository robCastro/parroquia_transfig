<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        	'name' => 'Roberto Castro',
            'username' => 'robertoC',
        	'email' => 'roberto.ernesto.castro@gmail.com',
        	'password' => bcrypt('GrupoTpi3'),
            'estado' => 'act',
            'type' => 'admin',
        ]);
    }
}
