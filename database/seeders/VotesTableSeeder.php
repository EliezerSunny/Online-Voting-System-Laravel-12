<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {




        Vote::create([
            "user_id"=> 1,
            "position_id"=> 1,
            "candidate_id"=> 1,
            "vote"=> 0,
        ]);
    }



}
