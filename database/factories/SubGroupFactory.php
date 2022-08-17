<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\SubGroup;
use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = SubGroup::class;

    public function definition()
    {
        return [
            'code_sub_group' => $this->faker->numberBetween(111,999),
            'code_main_group' => MainGroup::all()->random()->code_main_group,
            'code_group' => Group::all()->random()->code_group,
            'sub_group_name' => $this->faker->jobTitle(),
            'created_user' => "USR0001"
        ];
    }
}
