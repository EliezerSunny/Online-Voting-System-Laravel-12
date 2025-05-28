<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        DB::table('model_has_permissions')->insert([
            
            
            [
                "permission_id"=> 1,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],

            [
                "permission_id"=> 2,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],

            [
                "permission_id"=> 3,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],

            [
                "permission_id"=> 4,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],

            [
                "permission_id"=> 5,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],

            [
                "permission_id"=> 6,
                "model_type"=> "App\Models\User",
                "model_id"=> 1,
            ],
            


        ]);



    }
}
