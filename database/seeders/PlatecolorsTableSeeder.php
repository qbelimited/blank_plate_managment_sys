<?php

namespace Database\Seeders;

use App\Models\PlateColor;
use Illuminate\Database\Seeder;

class PlateColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlateColor::create([
            'color' => 'White',
            'code' => '1',
        ]);

        PlateColor::create([
            'color' => 'Yellow',
            'code' => '2',
        ]);

        PlateColor::create([
            'color' => 'Red',
            'code' => '3',
        ]);

        PlateColor::create([
            'color' => 'Green',
            'code' => '4',
        ]);

        PlateColor::create([
            'color' => 'Blue',
            'code' => '5',
        ]);
    }
}
