<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        


        Position::create([
            "code" => "a",
            "name" => "President",
            "party" => "Sunny",
            "created_by" => "Eliazer",
        ]);

        Position::create([
            "code" => "b",
            "name" => "Vice President",
            "party" => "sunny",
            "created_by" => "Eliazer",
        ]);

        Position::create([
            "code" => "c",
            "name" => "Secretary",
            "party" => "sunny",
            "created_by" => "Eliazer",
        ]);

        Position::create([
            "code" => "d",
            "name" => "Assistant Secretary",
            "party" => "sunny",
            "created_by" => "Eliazer",
        ]);

        Position::create([
            "code" => "e",
            "name" => "Treasurer",
            "party" => "sunny",
            "created_by" => "Eliazer",
        ]);



        
    }
}
