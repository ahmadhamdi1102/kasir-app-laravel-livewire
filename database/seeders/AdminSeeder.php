<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            "name" => "Ahmad Hamdi",
            "email" => "ahmad@gmail.com",
            "role" => "admin",
            "password" => Hash::make("ahmad123")

        ]);
    }
}
