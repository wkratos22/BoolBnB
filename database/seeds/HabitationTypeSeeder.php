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
        $types = [
            'Appartamento',
            'Villa',
            'B&B',
            'Baita',
            'Chalet',
            'Camping',
            'Hotel',
            'Minicasa',
        ];

        foreach($types as $type){
            $new_type = new HabitationType();
            $new_type->label = $type;
            $new_type->icon = $type;
        }
    }
}
