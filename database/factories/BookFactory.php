<?php

namespace Database\Factories;

use App\Models\Book;
use Database\Factories\Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(15),
            'category_id' => $this->faker->numberBetween(1,5),
            'status' => $this->faker->boolean(),
        ];
    }
}
