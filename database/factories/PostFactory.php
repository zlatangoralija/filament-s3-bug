<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $toReturn = [];
        $toReturn = [
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
        ];
        return $toReturn;
    }
}
