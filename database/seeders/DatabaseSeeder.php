<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::insert([
        //     'name'=>'Salih Tekin',
        //     'email'=>'st@st',
        //     'email_verified_at' => now(),
        //     'type'=>'admin',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);         bunuda UserSeeder a ekledik artık buraya gerek yok
//her seede ayrı çagıracagız aşagıdaki thiscall ile
                $this->call([
                        UserSeeder::class,
                        QuizSeeder::class,
                ]);
        // \App\Models\User::factory(5)->create(); //bu şekilde herkes kendi seedini çagırır çalıştırır hepsi bu sayfada değil yani herkes kendi seed bu user ın seedi
         //buradan kesip Userseeder a QuizSeeder a ekledik

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
