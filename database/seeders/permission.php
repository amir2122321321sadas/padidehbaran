<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class permission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'admin',
           'email' => 'jafari29225@gmail.com',
           'password' => Hash::make('dg2ad433'),
            'identification_code' => rand(0 , 1000000)
        ]);
    }
}
