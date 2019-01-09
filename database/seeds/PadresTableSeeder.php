<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PadresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('padres')->insert([
        	'nombre' => 'José Alberto',
        	'apellido' => 'Caceceres Fuentes',
        	'padreActual' => True,
        	'esObispo' => False,
        ]);
        DB::table('padres')->insert([
        	'nombre' => 'Esaú',
        	'apellido' => 'Rivas Rivas',
        	'padreActual' => False,
        	'esObispo' => True,
        ]);
    }
}
