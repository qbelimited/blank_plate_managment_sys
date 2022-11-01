<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'code' => 'GHA',
            'currency' => 'Cedi',
        ]);

        Currency::create([
            'code' => 'USD',
            'currency' => 'Dollar',
        ]);

        Currency::create([
            'code' => 'GBP',
            'currency' => 'Pounds',
        ]);
    }
}
