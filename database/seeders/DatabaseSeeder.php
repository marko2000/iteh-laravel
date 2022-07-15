<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Author;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        User::truncate();
        Song::truncate();
        Author::truncate();

        $this->call([
            CategorySeeder::class
        ]);

         Song::factory(10)->create();
    }
}
