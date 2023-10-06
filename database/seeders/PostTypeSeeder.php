<?php

namespace Database\Seeders;

use App\Models\PostType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postTypes = PostType::factory()->count(100)->make();
        foreach ($postTypes as $postType) {
            DB::table('post_types')->insert([
                'type' => $postType['type'],
            ]);
        }
    }
}
