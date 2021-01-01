<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_name' => $this->faker->name(),
            'book_text' => $this->faker->text(),
            'price' => $this->faker->numberBetween($min = 1500, $max = 8000),
            'image'=> 'img/book.png',
            'genre_id' => Genre::pluck('id')->random()
        ];
    }
}
