<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Crew;
use App\Models\Part;
use App\Models\Ship;
use App\Models\Unit;
use App\Models\Group;
use App\Models\Vendor;
use App\Models\Country;
use App\Models\SubGroup;
use App\Models\Component;
use App\Models\Counter;
use App\Models\MainGroup;
use App\Models\Departement;
use App\Models\JenisIdentitas;
use App\Models\MasterCrewCertificate;
use App\Models\Position;
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
        \App\Models\User::factory(10)->create();

        Ship::factory(10)->create();
        Vendor::factory(10)->create();
        Departement::factory(10)->create();
        Country::factory(10)->create();
        JenisIdentitas::factory(10)->create();
        Crew::factory(10)->create();
        MainGroup::factory(2)->create();
        Group::factory(2)->create();
        SubGroup::factory(2)->create();
        Unit::factory(2)->create();
        Component::factory(2)->create();
        Part::factory(2)->create();
        Bank::factory(10)->create();
        Position::factory(10)->create();
        MasterCrewCertificate::factory(10)->create();
        Counter::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
