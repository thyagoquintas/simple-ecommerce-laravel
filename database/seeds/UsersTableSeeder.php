<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email','thyagoquintas@hotmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Thyago Quintas',
                'email' => 'thyagoquintas@hotmail.com',
                'password' => Hash::make('123456789'),
                'role' => 'admin'
            ]);
        }
    }
}
