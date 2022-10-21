<?php

namespace Database\Seeders;

use App\Models\Plate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plate::create([
            'number_plate' => 'AC-001 GH',
            'plate_color_id' => 1,
            'plate_dimension_id' => 1,
            'serial_number_id' => 1
        ]);

        Plate::create([
            'number_plate' => 'AC-002 GH',
            'plate_color_id' => 1,
            'plate_dimension_id' => 1,
            'serial_number_id' => 1
        ]);

        Plate::create([
            'number_plate' => 'AC-003 GH',
            'plate_color_id' => 1,
            'plate_dimension_id' => 1,
            'serial_number_id' => 1
        ]);
    }
}
