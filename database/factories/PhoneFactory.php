<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->regexify('0[4-7][0-9]{8}'),
            'primary' => false,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function isPrimary()
    {
        return $this->state(function (array $attributes) {
            return [
                'primary' => true,
            ];
        });
    }
}
