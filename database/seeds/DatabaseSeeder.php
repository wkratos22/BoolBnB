<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                HabitationTypeSeeder::class,
                HabitationSeeder::class,
                TagSeeder::class,
                ServiceSeeder::class,
                MessageSeeder::class,
                SponsorshipSeeder::class,
            ]
    
    );
    }
}
