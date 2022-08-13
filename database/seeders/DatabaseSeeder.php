<?php

namespace Database\Seeders;

use App\Models\Crew;
use App\Models\Ship;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\Departement;
use App\Models\JenisIdentitas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        Ship::factory(10)->create();
        Vendor::factory(10)->create();
        Departement::factory(10)->create();
        Country::factory(10)->create();
        JenisIdentitas::factory(10)->create();
        Crew::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
