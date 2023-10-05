<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();
        $typeOneGroup = [];
        $typeTwoGroup = [];
        $typeThreeGroup = [];
        foreach ($users as $user) {
            if ($user->group === 1) {
                $typeOneGroup[] = $user;
            };
            if ($user->group === 2) {
                $typeTwoGroup[] = $user;
            };
            if ($user->group === 3) {
                $typeThreeGroup[] = $user;
            };
        }
        foreach ($typeOneGroup as $typeOne) {
            $faker = \Faker\Factory::create();
            for ($i = 1; $i <= 20; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $typeOne->id,
                    'category_id' => rand(1, 100),
                    'type_id' => rand(1, 100),
                    'title' => Str::random(10),
                    'description' => Str::random(100),
                    'country_id' => rand(1, 242),
                    'city' => Str::random(7),
                    'address' => Str::random(10),
                    'zip_code' => $faker->postcode(),
                    'latitude' => rand(1, 100) / 10,
                    'longitude' => rand(1, 100) / 10,
                    'status' => rand(1, 10),
                    'price' => rand(1, 100)
                ]);
            }
        }
        foreach ($typeTwoGroup as $typeTwo) {
            $faker = \Faker\Factory::create();
            for ($i = 1; $i <= 20; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $typeTwo->id,
                    'category_id' => rand(1, 100),
                    'type_id' => rand(1, 100),
                    'title' => Str::random(10),
                    'description' => Str::random(100),
                    'country_id' => rand(1, 242),
                    'city' => Str::random(7),
                    'address' => Str::random(10),
                    'zip_code' => $faker->postcode(),
                    'latitude' => rand(1, 100) / 10,
                    'longitude' => rand(1, 100) / 10,
                    'status' => rand(1, 10),
                    'price' => rand(1, 100)
                ]);
            }
        }
        foreach ($typeThreeGroup as $typeThree) {
            $faker = \Faker\Factory::create();
            for ($i = 1; $i <= 20; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $typeThree->id,
                    'category_id' => rand(1, 100),
                    'type_id' => rand(1, 100),
                    'title' => Str::random(10),
                    'description' => Str::random(100),
                    'country_id' => rand(1, 242),
                    'city' => Str::random(7),
                    'address' => Str::random(10),
                    'zip_code' => $faker->postcode(),
                    'latitude' => rand(1, 100) / 10,
                    'longitude' => rand(1, 100) / 10,
                    'status' => rand(1, 10),
                    'price' => rand(1, 100)
                ]);
            }
        }
    }
}
