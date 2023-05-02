<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ar_faker = \Faker\Factory::create('ar_JO');

        return [
            'ar_fname' => $ar_faker->firstName(),
            'ar_lname' => $ar_faker->lastName(),
            'bday' => $this->faker->dateTimeBetween('-18 years', '-5 years')->format('Y-m-d'),
            'bplace' => $this->faker->city(),
            'sex' => $this->faker->randomElement(config('rules.sex.in')),
            'nationality' => $this->faker->randomElement(['Algérienne', 'Algérienne', 'Algérienne', $this->faker->country()]),
        ];
    }
}
