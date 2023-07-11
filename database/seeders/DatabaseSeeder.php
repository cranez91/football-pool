<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\NationalTeamSeeder;
use Database\Seeders\TeamSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            CountrySeeder::class,
            NationalTeamSeeder::class,
            TeamSeeder::class
        ]);
    }
}
