<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PadrinoConfirmasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino1-1',
        	'apellido' => 'confirma1',
        	'sexo' => True,
        	'confirma_id' => 1,
        ]);
        
        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino2-1',
        	'apellido' => 'confirma1',
        	'sexo' => False,
        	'confirma_id' => 1,
        ]);

        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino3-2',
        	'apellido' => 'confirma2',
        	'sexo' => True,
        	'confirma_id' => 2,
        ]);
        
        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino4-2',
        	'apellido' => 'confirma2',
        	'sexo' => False,
        	'confirma_id' => 2,
        ]);
        
        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino5-3',
        	'apellido' => 'confirma3',
        	'sexo' => True,
        	'confirma_id' => 3,
        ]);
        
        DB::table('padrino_confirmas')->insert([
        	'nombre' => 'padrino6-3',
        	'apellido' => 'confirma3',
        	'sexo' => False,
        	'confirma_id' => 3,
        ]);
    }
}
