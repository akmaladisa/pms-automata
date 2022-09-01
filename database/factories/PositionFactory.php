<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Position::class;

    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle()
        ];
    }
}
