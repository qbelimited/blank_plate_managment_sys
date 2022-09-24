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
        Platedimension::create([
            'dimensions' => '520x112',
        ]);

        Platedimension::create([
            'dimensions' => '340x260',
        ]);

        Platedimension::create([
            'dimensions' => '240x260',
        ]);
    }
}
