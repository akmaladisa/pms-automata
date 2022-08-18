<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\MainGroup;
use App\Models\SubGroup;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Unit::class;

    public function definition()
    {
        return [
            'code_unit' => $this->faker->numberBetween(111111,999999),
            'code_main_group' => MainGroup::all()->random()->code_main_group,
            'code_group' => Group::all()->random()->code_group,
            "code_sub_group" => SubGroup::all()->random()->code_sub_group,
            'unit_name' => $this->faker->jobTitle(),
            'created_user' => "USR0001"
        ];
    }
}
