<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * @author medilies
     */
    public function definition(): array
    {
        $capacity_min = rand(15, 23);

        return [
            'name' => $this->faker->bothify('??????-##'),
            'capacity_min' => $capacity_min,
            'capacity_max' => $capacity_min + rand(5, 10),
        ];
    }
}
