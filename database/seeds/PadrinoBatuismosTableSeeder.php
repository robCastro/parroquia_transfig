<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PadrinoBatuismosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino1-1',
        	'apellido' => 'apellido1-1',
        	'sexo' => True,
        	'bautismo_id' => 1,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino2-1',
        	'apellido' => 'apellido2-1',
        	'sexo' => False,
        	'bautismo_id' => 1,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino3-2',
        	'apellido' => 'apellido3-2',
        	'sexo' => True,
        	'bautismo_id' => 2,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino4-2',
        	'apellido' => 'apellido4-2',
        	'sexo' => False,
        	'bautismo_id' => 2,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino5-3',
        	'apellido' => 'apellido5-3',
        	'sexo' => True,
        	'bautismo_id' => 3,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino6-3',
        	'apellido' => 'apellido6-3',
        	'sexo' => False,
        	'bautismo_id' => 3,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino7-4',
        	'apellido' => 'apellido7-4',
        	'sexo' => True,
        	'bautismo_id' => 4,
        ]);
        DB::table('padrino_bautismos')->insert([
        	'nombre' => 'padrino8-4',
        	'apellido' => 'apellido8-4',
        	'sexo' => False,
        	'bautismo_id' => 4,
        ]);
    }
}
