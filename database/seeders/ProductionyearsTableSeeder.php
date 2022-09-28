<?php

namespace Database\Seeders;

use App\Models\ProductionYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionyearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionYear::create([
            'description' => '2022',
            'code' => '1',
        ]);
        ProductionYear::create([
            'description' => '2023',
            'code' => '2',
        ]);
        ProductionYear::create([
            'description' => '2024',
            'code' => '3',
        ]);
        ProductionYear::create([
            'description' => '2025',
            'code' => '4',
        ]);
    }
}
