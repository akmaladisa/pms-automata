<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Component;
use App\Models\MainGroup;
use App\Models\SubGroup;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Component::class;

    public function definition()
    {
        return [
            'code_component' => $this->faker->numberBetween( 100000000 ,999999999 ),
            'code_main_group' => MainGroup::all()->random()->code_main_group,
            'code_group' => Group::all()->random()->code_group,
            'code_sub_group' => SubGroup::all()->random()->code_sub_group,
            'code_unit' => Unit::all()->random()->code_unit,
            'component_name' => $this->faker->word(),
            'is_deleted' => 0,
            'created_user' => "USR0001"
        ];
    }
}
