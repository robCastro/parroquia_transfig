<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /*

        IMPORTANTE: ESTE SEEDER FALLARÁ SI NO SE ALIMENTA MANUALMENTE CON CSV EL MUNICIPIO Y LA
        NACIONALIDAD DE LA PERSONA.

    */

    public function run()
    {
        DB::table('personas')->insert([
        	'nombre' => 'Juan',
        	'apellido' => 'Solo Bautismo',
        	'fechanac' => '2012/12/12',
        	'sexo' => True,
        	'papa' => 'Manuel Esau Perez Perez',
        	'mama' => 'Isabelle Arely Zelaya Fuentes',
            'id_nacionalidad' => 54,
            'id_municipio' => 204,
        ]);
        DB::table('personas')->insert([
        	'nombre' => 'Maria',
        	'apellido' => 'Bautismo Confirma',
        	'fechanac' => '2002/12/12',
        	'sexo' => False,
        	'papa' => 'Manuel Esau Perez Perez',
        	'mama' => 'Isabelle Arely Zelaya Fuentes',
            'id_nacionalidad' => 54,
            'id_municipio' => 205,
        ]);
        DB::table('personas')->insert([
        	'nombre' => 'Manuel',
        	'apellido' => 'Casado',
        	'fechanac' => '1992/12/12',
        	'sexo' => True,
        	'papa' => 'José María Díaz Díaz',
        	'mama' => 'Elba Nuñez Díaz',
            'id_nacionalidad' => 54,
            'id_municipio' => 206,
        ]);
        //Persona NO salvadoreña
        DB::table('personas')->insert([
        	'nombre' => 'Zoila',
        	'apellido' => 'Casada',
        	'fechanac' => '1992/12/12',
        	'sexo' => True,
        	'papa' => 'Daniel Juarez',
        	'mama' => 'Zoila Henríquez',
            'id_nacionalidad' => 28,
        ]);
    }
}
