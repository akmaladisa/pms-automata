<?php

namespace Database\Factories;

use App\Models\Departement;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Departement::class;

    public function definition()
    {
        return [
            'departement_id' => "DEP" . $this->faker->numberBetween(1000, 9999),
            'departement_name' => $this->faker->jobTitle(),
            'status' => "ACT",
            'created_user' => "USR" . $this->faker->numberBetween(1000, 9999)
        ];
    }
}
