<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BautismosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bautismos')->insert([
        	'fecha' => '2012/12/12',
        	'libro' => 51,
        	'acta' => 1,
        	'persona_id' => 1,
        	'padre_id' => 1,
        ]);
        DB::table('bautismos')->insert([
        	'fecha' => '2002/12/12',
        	'libro' => 3,
        	'acta' => 1,
        	'persona_id' => 2,
        	'padre_id' => 1,
        ]);
        DB::table('bautismos')->insert([
        	'fecha' => '1992/12/12',
        	'libro' => 1,
        	'acta' => 1,
        	'persona_id' => 3,
        	'padre_id' => 1,
        ]);
        DB::table('bautismos')->insert([
        	'fecha' => '1992/12/12',
        	'libro' => 1,
        	'acta' => 2,
        	'persona_id' => 4,
        	'padre_id' => 1,
        ]);
    }
}
