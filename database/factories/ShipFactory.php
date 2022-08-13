<?php

namespace Database\Factories;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Ship::class;
    
    public function definition()
    {
        return [
            'id_ship' => 'SHP' . $this->faker->numberBetween(1000, 9999),
            'ship_nm' => $this->faker->name(),
            'description' => $this->faker->text(123),
            'status' => "ACT",
            'created_user' => "USR". $this->faker->numberBetween(1000, 9999)
        ];
    }
}
