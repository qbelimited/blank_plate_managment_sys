<?php

namespace Database\Seeders;

use App\Models\Serialnumber;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SerialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serialnumber::create([
            'production_id' => 1,
            'serial' => "SSS001"
        ]);

        Serialnumber::create([
            'production_id' => 1,
            'serial' => "SSS002"
        ]);
    }
}
