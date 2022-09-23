<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_login' => 'USR' . $this->faker->numberBetween(1000, 9999),
            'id_crew' => 'CR' . $this->faker->numberBetween(1000, 9999),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => Hash::make('admin123'),
            'level_akses' => $this->faker->numberBetween(1,9),
            'role' => $this->faker->jobTitle(),
            'status' => 'active',
            'created_user' => Str::random(5),
            'updated_user' => Str::random(5),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
