<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = User::where("email", "demo@bitsnpixs.com")->count();

        if ($user == 0)
            User::create([
                "name" => "Demo User",
                "email" => "demo@bitsnpixs.com",
                "password" => Hash::make("abc@123"),
                "status" => 1
            ]);

        Model::reguard();
    }
}
