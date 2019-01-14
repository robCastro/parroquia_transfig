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
            'username' => 'robcastro',
        	'email' => 'roberto.ernesto.castro@gmail.com',
        	'password' => bcrypt('GrupoTpi3'),
            'activo' => True,
            'type' => 'user',
            
        ]);
    }
}
