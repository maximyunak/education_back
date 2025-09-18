<?php

namespace Database\Seeders;

use App\Models\Role;
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

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'user',
        ]);

        Role::create([
            'name' => 'teacher',
        ]);

        User::create([
            'first_name' => 'max',
            'last_name' => 'max',
            'phone' => 'phone1',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role_id' => 1,
        ]);

        User::create([
            'first_name' => 'max',
            'last_name' => 'max',
            'phone' => 'phone2',
            'email' => 'user@gmail.com',
            'password' => '12345678',
            'role_id' => 2,
        ]);

        User::create([
            'first_name' => 'max',
            'last_name' => 'max',
            'phone' => 'phone3',
            'email' => 'teacher@gmail.com',
            'password' => '12345678',
            'role_id' => 3,
        ]);

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
