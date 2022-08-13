<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Country::class;
    
    public function definition()
    {
        return [
            'id_country' => "CNM" . $this->faker->numberBetween(10000, 99999),
            'country_nm' => $this->faker->country(),
            'description' => $this->faker->text(123),
            'status' => "ACT",
            'created_user' => "USR" . $this->faker->numberBetween(1000,9999)
        ];
    }
}
