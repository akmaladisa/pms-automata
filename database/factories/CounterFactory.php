<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\Counter;
use App\Models\Part;
use App\Models\Ship;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Counter::class;

    public function definition()
    {
        return [
            'ship_name' => Ship::all()->random()->ship_nm,
            'date' => $this->faker->date(),
            'item_description' => $this->faker->randomElement([
                Part::all()->random()->code_part . ' - ' . Part::all()->random()->part_name,
                Component::all()->random()->code_component . ' - ' . Component::all()->random()->component_name,
                Unit::all()->random()->code_unit . ' - ' . Unit::all()->random()->unit_name]),
            'part_no' => $this->faker->numberBetween(1000, 9999),
            'starting_of_running_hours' => $this->faker->numberBetween(10,200),
            'unit_runing' => 'HOURS',
            'remarks' => $this->faker->text(10),
            'status' => "ACT"
        ];
    }
}
