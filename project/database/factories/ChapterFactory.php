<?php

namespace Database\Factories;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence, // Tựa đề chương
            'content' => $this->faker->paragraphs(3, true), // Nội dung chương
            'book_id' => Book::factory(), // Liên kết đến một cuốn sách
        ];
    }
}
