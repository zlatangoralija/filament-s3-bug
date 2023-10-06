<?php

namespace Database\Seeders;

use App\Models\Post;
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
        foreach ($users as $user) {
            if ($user->group === 2) {
                $posts = Post::factory()->count(20)->make();
                foreach ($posts as $post) {
                    DB::table('posts')->insert([
                        'user_id' => $user->id,
                        'category_id' => $post['category_id'],
                        'type_id' => $post['type_id'],
                        'title' => $post['title'],
                        'description' => $post['description'],
                        'country_id' => $post['country_id'],
                        'city' => $post['city'],
                        'address' => $post['address'],
                        'zip_code' => $post['zip_code'],
                        'latitude' => $post['latitude'],
                        'longitude' => $post['longitude'],
                        'status' => $post['status'],
                        'price' => $post['price']
                    ]);
                }
            }
            if ($user->group === 3) {
                $posts = Post::factory()->count(20)->make();
                foreach ($posts as $post) {
                    DB::table('posts')->insert([
                        'user_id' => $user->id,
                        'category_id' => $post['category_id'],
                        'type_id' => $post['type_id'],
                        'title' => $post['title'],
                        'description' => $post['description'],
                        'country_id' => $post['country_id'],
                        'city' => $post['city'],
                        'address' => $post['address'],
                        'zip_code' => $post['zip_code'],
                        'latitude' => $post['latitude'],
                        'longitude' => $post['longitude'],
                        'status' => $post['status'],
                        'price' => $post['price']
                    ]);
                }
            }
        }
    }
}
