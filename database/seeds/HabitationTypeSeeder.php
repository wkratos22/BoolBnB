<?php

use Illuminate\Database\Seeder;
use App\Models\HabitationType;

class HabitationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = config( 'habitation_types' );


        foreach($types as $type){
            $new_type = new HabitationType();
            $new_type->label = $type['label'];
            $new_type->icon = $type['icon'];
            $new_type->save();
        };
     }   
}

