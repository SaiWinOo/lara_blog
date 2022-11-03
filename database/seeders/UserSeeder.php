<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Sai Win Oo',
            'email' => 'saiwinoo25@gmail.com',
            'role'=> 'admin',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role'=> 'admin',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@gmail.com',
            'role'=> 'editor',
            'password' => Hash::make('asdffdsa'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'role'=> 'author',
            'password' => Hash::make('asdffdsa'),
        ]);
    }
}
