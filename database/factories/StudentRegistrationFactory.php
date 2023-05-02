<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentRegistration>
 */
class StudentRegistrationFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'deposition_date' => $this->faker->dateTimeBetween('-6 months')->format('Y-m-d'),
            'status' => 'pending',
        ];
    }
}
