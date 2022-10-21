<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Production;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Production::create([
            'plate_color_id' => 1,
            'plate_dimension_id' => 3,
            'quantity' => 17,
            'batch_code' => 1,
            'serial_starts' => 3,
            'production_week_id' => 1,
            'production_year_id' => 1,
            'manufacture_date' => Carbon::now(),
            'status' => 1
        ]);
    }
}
