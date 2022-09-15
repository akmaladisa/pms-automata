<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\Part;
use App\Models\Unit;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\MainGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Part::class;

    public function definition()
    {
        return [
            'code_part' => $this->faker->numberBetween( 100000000000 ,999999999999 ),
            'code_main_group' => MainGroup::all()->random()->code_main_group,
            'code_group' => Group::all()->random()->code_group,
            'code_sub_group' => SubGroup::all()->random()->code_sub_group,
            'code_unit' => Unit::all()->random()->code_unit,
            'code_component' => Component::all()->random()->code_component,
            'part_name' => $this->faker->word(),
            'created_user' => "USR0001"
        ];
    }
}
