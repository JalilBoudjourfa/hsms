<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentInterview>
 */
class StudentInterviewFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'schedule' => $this->faker->dateTimeInInterval('+3 days', '+1 week')->format('o-m-d H:i'),
            'father' => $this->faker->boolean(),
            'mother'=> $this->faker->boolean(),
            'interrogators' => $this->faker->optional('0.1', 'DG')->randomElement(['directeur primaire']),
            'conclusion' => $this->faker->optional(0.9, '')->randomElement(config('rules.registration_interview_conclusion.in')),
            'title' => "Entretien d'inscription",
            'note' => $this->faker->optional(0.3, null)->sentence(),
        ];
    }
}
