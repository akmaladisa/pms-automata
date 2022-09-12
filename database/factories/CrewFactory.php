<?php

namespace Database\Factories;

use App\Models\Crew;
use App\Models\Country;
use App\Models\JenisIdentitas;
use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

class CrewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Crew::class;

    public function definition()
    {
        return [
            'id_crew' => "CR" . $this->faker->numberBetween(10000, 99999),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'identity_type' => JenisIdentitas::all()->random()->id,
            'identity_number' => $this->faker->numberBetween(100,999),
            'job_title' => $this->faker->jobTitle(),
            'country' => Country::all()->random()->id_country,
            'phone' => $this->faker->phoneNumber(),
            'whatsapp_phone' => $this->faker->e164PhoneNumber(),
            'gender' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'status_merital' => $this->faker->randomElement(['SINGLE', 'MARRIED']),
            'pob' => $this->faker->city(),
            'dob' => $this->faker->date(),
            'duty_on_ship' => Ship::all()->random()->id_ship,
            'address' => $this->faker->address(),
            'join_date' => $this->faker->dateTime(),
            'note' => $this->faker->text(80),
            'status' => "ACT",
            'employment_status' => $this->faker->randomElement(['Contract', 'Permanent']),
            'join_port' => $this->faker->dateTime(),
            // 'photo' => $faker->image(public_path('storage\crew-img'), 200, 200, ['people']),
            'created_user' => "USR" . $this->faker->numberBetween(1000,9999)
        ];
    }
}
