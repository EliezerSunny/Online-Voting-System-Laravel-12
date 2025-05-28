<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "unique_id"=> rand(time(), 100000000),
            "first_name"=> "Eliazer",
            "last_name"=> "Adetunji",
            "other_name"=> "Adetayo",
            "username"=> "Eliazer",
            "gender"=> "Male",
            "slug"=> "eliazer",
            "email"=> "eliezersunny@gmail.com",
            "password"=> bcrypt("12345678"),
            "image"=> "users/avatar.png",
            "phone_number"=> "08154596494",
            "status"=> "Offline",
            "last_seen"=> now(),
            "vote"=> false,
            "is_admin" => true,
            "created_by"=> "Eliazer",
        ]);
    }
}
