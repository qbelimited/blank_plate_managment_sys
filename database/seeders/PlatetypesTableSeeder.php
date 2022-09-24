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
        Platetype::create([
            'color' => 'White',
        ]);

        Platetype::create([
            'color' => 'Yellow',
        ]);

        Platetype::create([
            'color' => 'Blue',
        ]);

        Platetype::create([
            'color' => 'Red',
        ]);

        Platetype::create([
            'color' => 'Green',
        ]);
    }
}
