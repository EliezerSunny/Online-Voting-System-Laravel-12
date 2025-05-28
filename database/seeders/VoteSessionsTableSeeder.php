<?php

namespace Database\Seeders;

use App\Models\VoteSession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VoteSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        VoteSession::create([
            "vote_ends_at"=> now()->addMinutes(5),
            "active"=> true,
            "created_by"=> "Eliazer",
        ]);



    }
}
