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
        $this->call([
            CompaniesTableSeeder::class,
            UsersTableSeeder::class,
            PlateColorsTableSeeder::class,
            PlatedimensionsTableSeeder::class,
            ProductionweeksTableSeeder::class,
            ProductionyearsTableSeeder::class,
        ]);
    }
}
