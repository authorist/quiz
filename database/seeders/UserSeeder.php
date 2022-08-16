<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name'=>'Salih Tekin',
            'email'=>'st@st',
            'email_verified_at' => now(),
            'type'=>'admin',
            'password' => '$2a$12$mpmeIFf5xsvAO9G1.BCxTuA0la3foshh5qvt.SUEfgFXQJJ/6eX.u', // laravel hash generator----https://bcrypt-generator.com/
            'remember_token' => Str::random(10),
        ]);      //bu manuel ekleme herhalde php artisan migrate:fresh oldugunda bunu tekrar ekler hatta seed de ne varsa ekler mesela aşagıda 10 tane user bununla birlikte 11 user oluşur

        \App\Models\User::factory(10)->create(); 
    }
}
