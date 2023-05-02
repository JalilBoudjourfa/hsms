<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExRegistraion>
 */
class ExRegistrationFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'establishment_name' => $this->faker->company(),
            'establishment_type' => $this->faker->randomElement(config('rules.establishment_type.in')),
            'class_type_id' => $this->faker->numberBetween(1, 15),
            'grade_1' => $this->faker->numberBetween(5, 15),
            'grade_2' => $this->faker->numberBetween(5, 15),
            'grade_3' => $this->faker->numberBetween(5, 15),
        ];
    }
}
