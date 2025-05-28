<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\VotesTableSeeder;
use Database\Seeders\AdminsTableSeeder;
use Database\Seeders\ModelHasRolesSeeder;
use Database\Seeders\PositionsTableSeeder;
use Database\Seeders\CandidatesTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\ModelHasPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            CandidatesTableSeeder::class,
            PositionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            VotesTableSeeder::class,
            ModelHasPermissionsSeeder::class,
            ModelHasRolesSeeder::class,
            VoteSessionsTableSeeder::class,
        ]);

        
    }
}
