<?php

namespace Database\Seeders;

use App\Models\Platedimension;
use Illuminate\Database\Seeder;

class PlatedimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlateDimension::create([
            'dimensions' => '520x112',
        ]);

        PlateDimension::create([
            'dimensions' => '340x260',
        ]);

        PlateDimension::create([
            'dimensions' => '240x260',
        ]);
    }
}
