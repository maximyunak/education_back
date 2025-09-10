<?php

namespace Database\Seeders;

use App\Models\Theme;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'max',
            'last_name' => 'max',
            'phone' => 'phone',
            'email' => 'test',
            'password' => '12345',
        ]);

        // Theme::factory()->create([
        //     ""
        // ])

        Theme::create([
            'name' => 'Дизайн',
            'description' => 'Тема для тестов по дизайну и креативу',
        ]);

        Theme::create([
            'name' => 'IT',
            'description' => 'Тема для тестов по информационным технологиям',
        ]);

        Theme::create([
            'name' => 'Маркетинг',
            'description' => 'Тема для тестов по маркетингу и продажам',
        ]);
    }
}
