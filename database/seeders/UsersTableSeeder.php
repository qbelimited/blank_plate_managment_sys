<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fname' => 'Admin',
            'lname' => 'Super',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '0',
            'company_id' => '1',
        ]);

        User::create([
            'fname' => 'Manufacturer',
            'lname' => 'Admin',
            'email' => 'manf@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '1',
            'company_id' => '1',
        ]);

        User::create([
            'fname' => 'Dvla',
            'lname' => 'Admin',
            'email' => 'dvla@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '2',
            'company_id' => '1',
        ]);

        User::create([
            'fname' => 'Embosser',
            'lname' => 'Admin',
            'email' => 'emboss@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '3',
            'company_id' => '1',
        ]);
    }
}
