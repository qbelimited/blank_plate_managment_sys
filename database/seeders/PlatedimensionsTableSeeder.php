<?php

namespace Database\Seeders;

use App\Models\PlateDimension;
use Illuminate\Database\Seeder;

class PlateDimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlateDimension::create([
            'description' => 'Long',
            'dimensions' => '520*112',
            'code' => 'A',
            'status' => 1
        ]);

        PlateDimension::create([
            'description' => 'Oblong 1',
            'dimensions' => '340*160',
            'code' => 'B',
            'status' => 1
        ]);

        PlateDimension::create([
            'description' => 'Oblong 2',
            'dimensions' => '260*160',
            'code' => 'C',
            'status' => 1
        ]);
    }
}
