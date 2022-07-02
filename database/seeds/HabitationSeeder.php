<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Habitation;
use Illuminate\Support\Str;

class HabitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for($i = 0; $i < 10; $i++){
            $habitation = new Habitation();
            $habitation->user_id = 1;
            $habitation->habitation_type_id = $faker->numberBetween(1, 4);
            $habitation->title = $faker->text(80);
            $habitation->slug = Str::slug($habitation->title, '-');
            $habitation->description = $faker->paragraph(3);
            $habitation->price = $faker->randomFloat(2, 30, 99000);
            $habitation->address = $faker->address();
            $habitation->latitude = $faker->latitude($min = -90, $max = 90);
            $habitation->longitude = $faker->longitude($min = -180, $max = 180);
            $habitation->guests_number = $faker->randomDigitNotNull();
            $habitation->rooms_number = $faker->randomDigitNotNull();
            $habitation->beds_number = $faker->randomDigitNotNull();
            $habitation->bathrooms_number = $faker->randomDigitNotNull();
            $habitation->square_meters = $faker->numberBetween(50, 100);
            $habitation->image = $faker->imageUrl(250, 250, 'animals', true);
            $habitation->visible = $faker->numberBetween(0, 1);
            $habitation->save();
        }
    }
}
    

