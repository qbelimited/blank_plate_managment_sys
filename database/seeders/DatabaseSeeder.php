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
            PermissionTableSeeder::class,
            UsersTableSeeder::class,
            PlateColorsTableSeeder::class,
            PlateDimensionsTableSeeder::class,
            ProductionWeeksTableSeeder::class,
            ProductionYearsTableSeeder::class,
            ProductionTableSeeder::class,
            SerialTableSeeder::class,
            WarehouseTableSeeder::class,
            PlateTableSeeder::class,
            CurrencySeeder::class,

        ]);
    }
}
