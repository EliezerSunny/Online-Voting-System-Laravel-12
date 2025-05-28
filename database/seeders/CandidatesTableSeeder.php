<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CandidatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        Candidate::create([
            "unique_id"=> rand(time(), 100000000),
            "position_id"=> 1,
            "first_name"=> "Eliazer",
            "last_name"=> "Sunny",
            "other_name"=> Null,
            "username"=> "Eliazer",
            "gender"=> "Male",
            "slug"=> "eliazer",
            "email"=> "eliezersunny@gmail.com",
            "image"=> "candidates/avatar.png",
            "phone_number"=> "08154596494",
            "created_by"=> "Eliazer",
        ]);


    }
}
