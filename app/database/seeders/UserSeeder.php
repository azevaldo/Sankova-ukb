<?php

namespace Database\Seeders;

use App\Models\Desempenho;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user= User::create([
            "name"=>"admin",
            "email"=>"admin@gmail.com",
            "password"=>bcrypt("123456789"),
        ]);
        $user->assignRole('admin');
        Desempenho::create([
            "user_id"=>$user->id,
        ]);
    }
}
