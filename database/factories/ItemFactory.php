<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition()
    {
        return [
            'name'  => $this->faker->text(10),
            'condition'   => $this->faker->randomElement(['Good', 'New', 'Broken', 'Very good', 'Used']),
            'store_id' => $this->faker->numberBetween(1,20),
            'weight'  => $this->faker->numberBetween(0.1,10)
        ];
    }
}
