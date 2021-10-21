<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Arr;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caption' => $this->faker->word(),
            'info' => $this->faker->paragraph(),
            'status_id' => $this->faker->numberBetween(1, 2),
            'category_id' => \App\Models\Category::factory()->create(),
            'user_id' => \App\Models\User::factory()->create(),
        ];
    }
}
