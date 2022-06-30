<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Habitation;

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
            $habitation->title = $faker->text(80);
            $habitation->cntento = $faker->paragraph(3);
            $habitation->image = $faker->imageUrl(250, 250);
            $habitation->slug = Str::slug($message->title, '-');
            $habitation->save();
        }
    }
}
