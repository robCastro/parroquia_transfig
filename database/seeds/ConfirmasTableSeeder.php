<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfirmasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('confirmas')->insert([
        	'fecha' => '2005/12/12',
        	'libro' => 4,
        	'acta' => 1,
        	'pagina' => 1,
        	'persona_id' => 2,
        	'padre_id' => 2,
        ]);
        DB::table('confirmas')->insert([
        	'fecha' => '1995/12/12',
        	'libro' => 2,
        	'acta' => 1,
        	'pagina' => 1,
        	'persona_id' => 3,
        	'padre_id' => 2,
        ]);
        DB::table('confirmas')->insert([
        	'fecha' => '1995/12/12',
        	'libro' => 2,
        	'acta' => 1,
        	'pagina' => 2,
        	'persona_id' => 4,
        	'padre_id' => 2,
        ]);
    }
}
