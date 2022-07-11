<?php

use Illuminate\Database\Seeder;

use App\Models\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = config( 'habitation_sponsorships' );

        foreach($sponsorships as $sponsorship){
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->save();
        };
    }
}
