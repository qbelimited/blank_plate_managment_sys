<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Demo Company',
            'location'=> 'Tema',
            'phone'=>'905030333',
            'email'=>'demo@gmail.com',
            'status' => 1
        ]);
    }
}
