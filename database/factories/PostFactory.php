<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\PostType;
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

        return [
            'category_id' => rand(1, 100),
            'type_id' => PostType::inRandomOrder()->first()->id,
            'title' => $faker->company,
            'description' => $faker->text,
            'country_id' => rand(1, Country::count()),
            'city' => $faker->city,
            'address' => $faker->address,
            'zip_code' => $faker->postcode(),
            'latitude' => $faker->latitude,
            'longitude' => $faker->longitude,
            'status' => rand(0, 1),
            'price' => $faker->randomFloat()
        ];
    }
}
