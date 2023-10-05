<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 33; $i++) {
            DB::table('users')->insert([
                'id' => $i,
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'phone' => $faker->phoneNumber(),
                'company' => $faker->word . ' ' . $faker->word,
                'email' => Str::random(10) . '@gmail.com',
                'group' => 1,
                'country_id' => rand(1, 242),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(20),
            ]);
        }
        for ($i = 34; $i <= 66; $i++) {
            DB::table('users')->insert([
                'id' => $i,
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'phone' => $faker->phoneNumber(),
                'company' => $faker->word . ' ' . $faker->word,
                'email' => Str::random(10) . '@gmail.com',
                'group' => 2,
                'country_id' => rand(1, 242),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(20),
            ]);
        }
        for ($i = 67; $i <= 100; $i++) {
            DB::table('users')->insert([
                'id' => $i,
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'phone' => $faker->phoneNumber(),
                'company' => $faker->word . ' ' . $faker->word,
                'email' => Str::random(10) . '@gmail.com',
                'group' => 3,
                'country_id' => rand(1, 242),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(20),
            ]);
        }
    }
}
