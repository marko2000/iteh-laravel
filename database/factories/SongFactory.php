<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word(),
            'user_id'=>User::factory(),
            'author_id'=>Author::factory(),
            'category_id'=>$this->faker->numberBetween(1,9)
        ];
    }
}
