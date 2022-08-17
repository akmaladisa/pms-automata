<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Group::class;

    public function definition()
    {
        return [
            'code_group' => $this->faker->unique()->numberBetween(11,99),
            'code_main_group' => MainGroup::all()->random()->code_main_group,
            'group_name' => $this->faker->jobTitle(),
            'created_user' => "USR0001"
        ];
    }
}
