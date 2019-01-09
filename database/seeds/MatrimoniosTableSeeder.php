<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatrimoniosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matrimonios')->insert([
        	'fecha' => '2015/12/12',
        	'libro' => 5,
        	'folio' => 1,
        	'esposo_id' => 3,
        	'esposa_id' => 4,
        	'padre_id' => 1,
        ]);
    }
}
