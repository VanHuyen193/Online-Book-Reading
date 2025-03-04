<?php
namespace Database\Factories;
use App\Models\Chapter; 
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => implode("\n\n", $this->faker->paragraphs(3))
        ];
    }

    // Book::factory()->count(20)->hasChapters(5)->create();
}