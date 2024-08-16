<?php

namespace Database\Factories;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model=Expense::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'category_id'  => $this->faker->randomElement([47,51,52,53]),
            'amount' => $this->faker->numberBetween(500,50000),
            'payment_mode' => $this->faker->randomElement([1,2,3,4,5]),
            'tax_included' => $this->faker->randomElement([0,1]),
            'tax_percentage' => $this->faker->numberBetween(1,100) 
        ];
    }
}
