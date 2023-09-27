<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Test User 1',
             'email' => 'test1@prologis.com',
             'password' => '123456',
             'group' => 1
         ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@prologis.com',
            'password' => '123456',
            'group' => 2
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'test3@prologis.com',
            'password' => '123456',
            'group' => 3
        ]);
    }
}
