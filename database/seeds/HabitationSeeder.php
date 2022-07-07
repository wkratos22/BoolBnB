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

        $titles = [
            'Villa Pliniana',
            'Mirror House Sud',
            'Villa Richard Meier',
            'Chalet Orcianita',
            'Apartment Yoko',
            'Villa del Pescatore',
            'Villa Anna Capoferro',
            'Arco Iris',
            'Casa Falcucci',
            'Romantic Studio',
        ];
        
        $addresses = [
            'Via Emilio Gola 20, Milano, 20143',
            'Via Terracina 380, Napoli, 80125',
            'Via Giulia 201, Roma, 00186',
            'Via Michelangelo Tonti 28, Rimini, 47921',
            'Viale Rodi 5, Rimini, 47921',
            'Via Lincoln 90, Palermo, 90133',
            'Via Ignazio Buttitta 32,  San Vito lo capo, 91010',
            'Piazzetta Costa Smeralda, Porto Cervo, 07021',
            'Via Nazionale 10, Firenze, 50123',
            'Via Manfredo Camperio 9, Milano, 20123',
        ];

        
        for($i = 0; $i < 10; $i++){
            $habitation = new Habitation();
            $habitation->user_id = 1;
            $habitation->habitation_type_id = $faker->numberBetween(1, 4);
            $habitation->title = $titles[$i];
            $habitation->slug = Str::slug($habitation->title, '-');
            $habitation->description = $faker->paragraph(3);
            $habitation->price = $faker->numberBetween(25, 25000);

            // singolo elemento dell'array "addresses"
            $habitation->address = $addresses[$i];

            // recupero di lat e long
            $apiKey = "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl";
            $address = $addresses[$i];
            $address = urlencode($address);
            $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key={$apiKey}&limit=5&countrySet=IT&language=it-IT";
            $response_json = file_get_contents($url);
            $response = json_decode($response_json, true);

            // inserimento lat e lot nel rispettivo record
            $habitation->latitude = $response['results'][0]['position']['lat'];
            $habitation->longitude = $response['results'][0]['position']['lon'];

            $habitation->guests_number = $faker->numberBetween(2, 15);
            $habitation->rooms_number = $faker->numberBetween(3, 10);
            $habitation->beds_number = $faker->numberBetween(2, 15);
            $habitation->bathrooms_number = $faker->numberBetween(1, 5);
            $habitation->square_meters = $faker->numberBetween(50, 200);
            $habitation->visible = $faker->numberBetween(0, 1);
            $habitation->save();
        }
    }
}
    

