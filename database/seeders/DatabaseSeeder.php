<?php

namespace Database\Seeders;

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
        $seeders = array(
            'UsersTableSeeder::class',
            'PlatetypesTableSeeder::class',
            'PlatedimensionsTableSeeder::class'
        );

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
