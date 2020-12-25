<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
        $user->name = "admin";
        $user->username = "admin";
        $user->email = "nhattruong.truongcong@gmail.com";
        $user->password =Hash::make('123');
        $user->roles="1";
        $user->save();
    }
}
