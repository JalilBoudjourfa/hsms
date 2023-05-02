<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['scolarité', 'transport', 'restauration']).'-'.random_int(1, 2).'-'.$this->faker->randomElement(['primaire', 'moyen', 'secondaire']),
            'value' => $this->faker->numberBetween(1, 20) * 10_000,
            'mondatory' => $this->faker->boolean(),
            'start_date' => $this->faker->dateTimeInInterval('+2 weeks', '+5 weeks')->format('o-m-d h:i'),
            'end_date' => $this->faker->dateTimeInInterval('+11 weeks', '+13 weeks')->format('o-m-d h:i'),
        ];
    }
}
