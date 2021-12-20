<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
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
            'address'   => $this->faker->text(10),
            'city'   => $this->faker->text(10),
            'numberOfItems'   => $this->faker->numberBetween(50,10000),
        ];
    }
}
