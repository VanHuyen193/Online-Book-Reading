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

    // public function configure()
    // {
    //     return $this->afterCreating(function ($book) {  // Không cần khai báo kiểu dữ liệu ở đây
    //         // Tạo các chapter cho book
    //         $book->chapters()->createMany(Chapter::factory()->count(5)->make()->toArray());
    //     });
    // }
}