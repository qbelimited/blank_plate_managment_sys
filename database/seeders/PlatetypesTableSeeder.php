<?php

namespace Database\Seeders;

use App\Models\Platetype;
use Illuminate\Database\Seeder;

class PlatetypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlateType::create([
            'color' => 'White',
        ]);

        PlateType::create([
            'color' => 'Yellow',
        ]);

        PlateType::create([
            'color' => 'Blue',
        ]);

        PlateType::create([
            'color' => 'Red',
        ]);

        PlateType::create([
            'color' => 'Green',
        ]);
    }
}
