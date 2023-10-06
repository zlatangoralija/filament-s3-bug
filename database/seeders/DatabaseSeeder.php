<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\PostTypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Symfony\Component\Uid\Ulid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(PostTypeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
    }
}
