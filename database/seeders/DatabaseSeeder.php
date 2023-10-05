<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Symfony\Component\Uid\Ulid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $country = Country::create([
            'name' => 'Germany',
            'code' => 'GER',
            'currency_code' => 'EUR'
        ]);

         \App\Models\User::factory()->create([
             'id' => Ulid::generate(),
             'first_name' => 'Test User 1',
             'last_name' => 'Test User 1',
             'email' => 'test1@prologis.com',
             'password' => '123456',
             'group' => 1,
             'country_id' => $country->id,
         ]);

        \App\Models\User::factory()->create([
            'id' => Ulid::generate(),
            'first_name' => 'Test User 2',
            'last_name' => 'Test User 2',
            'email' => 'test2@prologis.com',
            'password' => '123456',
            'group' => 2,
            'country_id' => $country->id,
        ]);

        \App\Models\User::factory()->create([
            'id' => Ulid::generate(),
            'first_name' => 'Test User 3',
            'last_name' => 'Test User 3',
            'email' => 'test3@prologis.com',
            'password' => '123456',
            'group' => 3,
            'country_id' => $country->id,
        ]);
    }
}
