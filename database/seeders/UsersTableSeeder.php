<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        // User::create([
        //     'fname' => 'Admin',
        //     'lname' => 'Super',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('admin1234'),
        //     'type' => '0',
        //     'company_id' => '1',
        // ]);

        // User::create([
        //     'fname' => 'Manufacturer',
        //     'lname' => 'Admin',
        //     'email' => 'manf@admin.com',
        //     'password' => bcrypt('admin1234'),
        //     'type' => '1',
        //     'company_id' => '1',
        // ]);

        // User::create([
        //     'fname' => 'Dvla',
        //     'lname' => 'Admin',
        //     'email' => 'dvla@admin.com',
        //     'password' => bcrypt('admin1234'),
        //     'type' => '2',
        //     'company_id' => '1',
        // ]);

        // User::create([
        //     'fname' => 'Embosser',
        //     'lname' => 'Admin',
        //     'email' => 'emboss@admin.com',
        //     'password' => bcrypt('admin1234'),
        //     'type' => '3',
        //     'company_id' => '1',
        // ]);

        //get all permissions
        $permissions = Permission::pluck('id', 'id')->all();

        //create the manufacturer role
        $admin = Role::create(['name' => 'Admin']);
        $admin->syncPermissions($permissions);

        $user = User::create([
            'fname' => 'Admin',
            'mname' => 'Admin',
            'lname' => 'Super',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '0',
            'company_id' => '1',
            'national_id' => 'gha-0002'
        ]);

        $user->assignRole([$admin->id]);


        //create the manufacturer role
        $manufacturer_role = Role::create(['name' => 'Manufacturer']);
        $manufacturer_role->syncPermissions($permissions);

        $user = User::create([
            'fname' => 'Manufacturer',
            'mname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'manf@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '1',
            'company_id' => '1',
            'national_id' => 'gha-0003'
        ]);

        $user->assignRole([$manufacturer_role->id]);


        //create the dvla role
        $dvla_role = Role::create(['name' => 'Dvla']);
        $dvla_role->syncPermissions($permissions);

        $user = User::create([
            'fname' => 'Dvla',
            'mname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'dvla@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '2',
            'company_id' => '1',
            'national_id' => 'gha-0004'
        ]);

        $user->assignRole([$dvla_role->id]);

        //create the Embosser role
        $embosser_role = Role::create(['name' => 'Embosser']);
        $embosser_role->syncPermissions($permissions);

        $user =  User::create([
            'fname' => 'Embosser',
            'mname' => 'Admin',
            'lname' => 'Admin',
            'email' => 'emboss@admin.com',
            'password' => bcrypt('admin1234'),
            'type' => '3',
            'company_id' => '1',
            'national_id' => 'gha-0005'
        ]);

        $user->assignRole([$embosser_role->id]);
    }
}
