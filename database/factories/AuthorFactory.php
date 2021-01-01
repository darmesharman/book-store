<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{

    protected $model = Author::class;


    public function definition()
    {
        return [
            'surname' => $this->faker->firstName,
            'name' => $this->faker->lastName
        ];
    }
}
