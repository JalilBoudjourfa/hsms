<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Establishment>
 */
class EstablishmentFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->company(),
        ];
    }
}
