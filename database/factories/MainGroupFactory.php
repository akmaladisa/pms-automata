<?php

namespace Database\Factories;

use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class MainGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = MainGroup::class;



    public function definition()
    {
        return [
            'kode_barang' => "KDBRG" . $this->faker->numberBetween(1000,9999),
            // 'code_main_group' => $this->faker->unique()->numberBetween(1, 9),
            'main_group_name' => $this->faker->jobTitle(),
            'created_user' => 'USR' . $this->faker->numberBetween(1000, 9999)
        ];
    }
}
