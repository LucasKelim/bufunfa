<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->randomFloat(2, 1, 500),
            'salary_id' => fake()->randomElement(Salary::pluck('id')),
            'category_id' => fake()->randomElement(Category::pluck('id'))
        ];
    }
}
