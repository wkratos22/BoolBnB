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
            'Rimini Luxury',
            'Villa del Pescatore',
            'Villa Anna Capoferro',
            'Arco Iris',
            'Casa Falcucci',
            'Romantic Studio',
            'Hotel Dolores',
            'Appartamento Il Saracino',
            'Villa Arizona',
            'Hotel Sport - Ricci Hotels',
            'Residence Altamarea',
            'One Design Hotel',
            'Residence Hamilton',
            'Fienile restaurato di 700 anni sulle colline bolognesi',
            'Cà di Viola',
            'Casa Rossana',
            'Grand Hotel Vesuvio',
            'Rubino Apartments',
            'Hotel De Angelis',
            'La Tonnarella',
        ];
        
        $addresses = [
            'Via Salvatore Quasimodo 7, Amalfi, 84011',
            'Viale Pasitea 180, Positano, 84017',
            'Via Giulia 201, Roma, 00186',
            'Via Michelangelo Tonti 28, Rimini, 47921',
            'Viale Rodi 5, Rimini, 47921',
            'Via Lincoln 90, Palermo, 90133',
            'Via Ignazio Buttitta 32,  San Vito lo capo, 91010',
            'Piazzetta Costa Smeralda, Porto Cervo, 07021',
            'Via Nazionale 10, Firenze, 50123',
            'Via Giambattista Lama 9, Furore, 84010',
            'Viale Isonzo 2, Cesenatico, 47042',
            'Via Luigi Pirandello 15, Cervia, 48015',
            'Via Pitagora 5, Cesenatico, 47042',
            'Via C. Vincenzi 36, San Mauro A Mare, 47030',
            'Viale Regina Elena 205, Rimini, 47924',
            'Viale Trento Trieste 44, Riccione, 47838',
            'Via III Traversa 26, Milano Marittima, 48015',
            "Via Tolara di Sopra 50, Ozzano dell'Emilia, 40064",
            'Via Carlo Jussi 174, Farneto, 40068',
            'Salita Apotheca 1, Amalfi, 84011',
            'Via Nastro Verde 7, Sorrento, 80067',
            'Viale Alessandro Tassoni 34, Riccione, 47838',
            'Viale Mameli 15, Riccione, 47838',
            'Via Capo 31, Sorrento, 80067'

        ];

        
        for($i = 0; $i < 24; $i++){
            $habitation = new Habitation();
            $habitation->user_id = $faker->numberBetween(1, 2);
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
    

