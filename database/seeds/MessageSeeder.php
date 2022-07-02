<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $message = new Message();
            $message->habitation_id = $faker->numberBetween(1,10);
            $message->name = $faker->name();
            $message->email_sender = $faker->email();
            $message->text_message = $faker->paragraph(4);
            $message->save();
        }
    }
}
