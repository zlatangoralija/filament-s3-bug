<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(100)->make();
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'parent_category_id' => $category['parent_category_id'],
            ]);
        }
    }
}
