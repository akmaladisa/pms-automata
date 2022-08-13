<?php

namespace Database\Factories;

use App\Models\JenisIdentitas;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisIdentitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = JenisIdentitas::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word
        ];
    }
}
