<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        Permission::create([
            "name"=> "Dashboard",
            "guard_name"=> "web",
        ]);

        Permission::create([
            "name"=> "Vote",
            "guard_name"=> "web",
        ]);

        Permission::create([
            "name"=> "Create",
            "guard_name"=> "web",
        ]);

        Permission::create([
            "name"=> "Read",
            "guard_name"=> "web",
        ]);

        Permission::create([
            "name"=> "Edit",
            "guard_name"=> "web",
        ]);

        Permission::create([
            "name"=> "Delete",
            "guard_name"=> "web",
        ]);



    }
}
