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
            'id_login' => 'USR0001',
            'id_crew' => 'CR0001',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'level_akses' => $this->faker->numberBetween(0,2),
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
