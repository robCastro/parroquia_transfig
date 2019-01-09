<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PadrinoMatrimoniosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('padrino_matrimonios')->insert([
        	'nombre' => 'padrino1',
        	'apellido' => 'matrimonio1',
        	'sexo' => True,
        	'matrimonio_id' => 1,
        ]);
    }
}
