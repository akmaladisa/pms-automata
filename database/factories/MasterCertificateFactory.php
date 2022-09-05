<?php

namespace Database\Factories;

use App\Models\MasterCrewCertificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterCertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = MasterCrewCertificate::class;

    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'type' => $this->faker->word()
        ];
    }
}
