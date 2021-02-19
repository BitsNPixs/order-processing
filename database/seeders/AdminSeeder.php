<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        $user = Admin::where("username", "admin")->count();

        if ($user == 0)
            Admin::create([
                "name" => "System Admin",
                "username" => "admin",
                "password" => Hash::make("abc@123"),
                "status" => 1,
                "type" => "admin"
            ]);

        Model::reguard();
    }
}
