<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->text(10),
            'price'   => $this->faker->numberBetween(0,10),
            'weight'   => $this->faker->numberBetween(0.1,10)
        ];
    }
}
