<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'profession' => $this->faker->jobTitle(),
            'address' => $this->faker->address(),
            'family_title' => $this->faker->randomElement(config('rules.family_title.in')),
        ];
    }

    public function isMother()
    {
        return $this->state(function (array $attributes) {
            return [
                'family_title' => 'mother',
            ];
        });
    }

    public function isFather()
    {
        return $this->state(function (array $attributes) {
            return [
                'family_title' => 'father',
            ];
        });
    }
}
