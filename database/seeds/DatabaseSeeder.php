<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
        	PadresTableSeeder::class,
            PersonasTableSeeder::class,
            BautismosTableSeeder::class,
            PadrinoBatuismosTableSeeder::class,
            ConfirmasTableSeeder::class,
            PadrinoConfirmasTableSeeder::class,
            MatrimoniosTableSeeder::class,
            PadrinoMatrimoniosTableSeeder::class,
        ]);
    }
}
