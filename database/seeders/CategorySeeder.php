<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Pop'
        ]);
        Category::create([
            'name'=>'Rock'
        ]);
        Category::create([
            'name'=>'Folk'
        ]);
        Category::create([
            'name'=>'Techno'
        ]);
        Category::create([
            'name'=>'Trance'
        ]);
        Category::create([
            'name'=>'RnB'
        ]);
        Category::create([
            'name'=>'Classic'
        ]);
    }
}