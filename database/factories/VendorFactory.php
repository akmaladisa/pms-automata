<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Vendor::class;

    public function definition()
    {
        return [
            'vendor_id' => "VID" . $this->faker->numberBetween(1000, 9999),
            'vendor_name' => $this->faker->company(),
            'status' => 'ACT',
            'created_user' => 'USR' .$this->faker->numberBetween(1000,9999)
        ];
    }
}
