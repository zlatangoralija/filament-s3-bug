<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = User::factory()->count(100)->make();
        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'first_name' => $user['id'],
                'last_name' => $user['last_name'],
                'phone' => $user['phone'],
                'company' => $user['company'],
                'email' => $user['email'],
                'group' => $user['group'],
                'country_id' => $user['country_id'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => $user['password'],
                'remember_token' => $user['remember_token'],
            ]);
        }
    }
}
