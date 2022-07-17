<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Habitation;
use App\Models\HabitationType;
use App\Models\Service;
use App\Models\Tag;
use App\Models\Image;

use Carbon\Carbon;

class HabitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            $user_hab = Auth::user()->habitations();



            // Tutti gli annunci pubblicati
            $habitations = $user_hab->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();

            // Annunci sponsorizzati attualmente
            $currentDate = Carbon::now('Europe/Rome')->toDateTimeString();

            $sponsoredHabs = Habitation::whereHas('sponsorships', function ($query) use ($currentDate){
                $query->where('end_date', '>=', $currentDate);
               })->where('user_id', Auth::user()->id)->get();

            // Annunci visibili
            $visibleHabs = $user_hab->where('user_id', Auth::user()->id)->where('visible', 1)->get();

            return view('admin.habitations.index', compact('habitations', 'sponsoredHabs', 'visibleHabs'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_hab = HabitationType::all();
        $tags_hab = Tag::all();
        $service_hab = Service::all();

        return view('admin.habitations.create', compact('type_hab', 'tags_hab', 'service_hab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'title'  => 'required|max:100|string|unique:habitations',
                'habitation_type_id' => 'required',
                'description'  => 'required|string',
                'price'  => 'required|integer||between:1,25000',
                'address'  => 'required|string',
                'guests_number'  => 'required|integer|min:1',
                'rooms_number'  => 'required|integer|min:1',
                'beds_number'  => 'required|integer|min:1',
                'bathrooms_number'  => 'required|integer|min:1',
                'square_meters'  => 'integer|min:1',

                'visible'  => 'required',
                'services'  => 'required',
                'tags'  => 'required',
            ],

            [
                'title.required' => 'Il <strong>titolo</strong> è un campo obbligatorio.',
                'title.max' => 'Il limite massimo di caratteri per il <strong>titolo</strong> è 100.',
                'title.string' => 'Il <strong>titolo</strong> deve essere una stringa.',
                'title.unique' => 'Il <strong>titolo</strong> selezionato già esiste, provane un altro.',

                'habitation_type_id.required' => 'La <strong>tipologia</strong> di struttura è un campo obbligatorio.',

                'description.required' => 'La <strong>descrizione</strong> è un campo obbligatorio.',
                'description.string' => 'La <strong>descrizione</strong> deve essere una stringa.',

                'price.required' => "Inserisci il <strong>prezzo</strong> per una singola notte.",
                'price.integer' => "Il <strong>prezzo</strong> deve essere un numero.",
                'price.between' => "Il <strong>prezzo</strong> deve essere compreso tra 1 e 25000.",

                'address.required' => "L'<strong>indirizzo</strong> è un campo obbligatorio.",
                'address.string' => "L'<strong>indirizzo</strong> deve essere una stringa.",

                'guests_number.required' => 'Il numero massimo di <strong>ospiti</strong> è un campo obbligatorio.',
                'guests_number.integer' => 'Inserisci un numero per stabilire la quantità massima di <strong>ospiti</strong>.',
                'guests_number.min' => 'Il numero minimo previsto per gli <strong>ospiti</strong> è 1.',

                'rooms_number.required' => 'Il numero di <strong>stanze</strong> è un campo obbligatorio.',
                'rooms_number.integer' => 'Inserisci un numero per stabilire la quantità di <strong>stanze</strong>.',
                'rooms_number.min' => 'Il numero minimo previsto per le <strong>stanze</strong> è 1.',

                'beds_number.required' => 'Il numero di <strong>letti</strong> è un campo obbligatorio.',
                'beds_number.integer' => 'Inserisci un numero per stabilire la quantità di <strong>letti</strong>.',
                'beds_number.min' => 'Il numero minimo previsto per i <strong>letti</strong> è 1.',

                'bathrooms_number.required' => 'Il numero di <strong>bagni</strong> è un campo obbligatorio.',
                'bathrooms_number.integer' => 'Inserisci un numero per stabilire la quantità di <strong>bagni</strong>.',
                'bathrooms_number.min' => 'Il numero minimo previsto per i <strong>bagni</strong> è 1.',

                'square_meters.integer' => 'Inserisci un numero per definire i <strong>metri</strong> quadrati della struttura.',
                'square_meters.min' => 'Il numero minimo previsto per i <strong>metri</strong> quadrati è 1.',

                'services.required' => 'Inserisci almeno un <strong>servizio</strong> presente nella struttura',

                'tags.required' => 'Inserisci almeno una <strong>caratteristica</strong> della struttura',
                ]
        );

        $data = $request->all();



        $new_habitation = new Habitation();

         // recupero di lat e long
         $apiKey = "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl";
         $address = $data['address'];
         $address = urlencode($address);
         $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key={$apiKey}&limit=5&countrySet=IT&language=it-IT";
         $response_json = file_get_contents($url);
         $response = json_decode($response_json, true);

         // inserimento lat e lot nel rispettivo record
         $new_habitation->latitude = $response['results'][0]['position']['lat'];
         $new_habitation->longitude = $response['results'][0]['position']['lon'];

        $new_habitation->fill($data);

        $new_habitation->user_id = Auth::user()->id;

        $new_habitation->slug = Str::slug($new_habitation->title, '-');

        $new_habitation->save();


        if (array_key_exists('image', $data)) {
            $files = $data['image'];

            foreach ($files as $file) {


                $new_image = new Image();

                $image_url = Storage::put('habitations_images', $file);

                $new_image->image_url = $image_url;
                $new_image->habitation_id = $new_habitation->id;

                $new_image->save();

            }
        }


        if (array_key_exists('tags', $data)) {

            $new_habitation->tags()->attach($data['tags']);
        }

        if (array_key_exists('services', $data)) {

            $new_habitation->services()->attach($data['services']);
        }


        return redirect()->route('admin.habitations.show', $new_habitation)->with('message', "L'annuncio <strong>$new_habitation->title</strong> è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Habitation $habitation)
    {
        if (Auth::user()->id == $habitation->user_id) {
            return view('admin.habitations.show', compact('habitation'));
        } return view('admin.pages.notFound');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitation $habitation)
    {
        $type_hab = HabitationType::all();
        $tags_hab = Tag::all();
        $service_hab = Service::all();

        $habitation_tags_id = $habitation->tags->pluck('id')->toArray();
        $habitation_services_id = $habitation->services->pluck('id')->toArray();

        if (Auth::user()->id == $habitation->user_id) {
            return view('admin.habitations.edit', compact('habitation', 'habitation_tags_id', 'habitation_services_id', 'type_hab', 'tags_hab', 'service_hab'));
        } return view('admin.pages.notFound');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitation $habitation)
    {
        $data = $request->all();

        $validator = $request->validate(
            [
                'title'  => 'required|max:100|string|unique:habitations,title,'.$habitation->id,
                'habitation_type_id' => 'required',
                'description'  => 'required|string',
                'price'  => 'required|integer|between:1,25000',
                'address'  => 'required|string',
                'guests_number'  => 'required|integer|min:1',
                'rooms_number'  => 'required|integer|min:1',
                'beds_number'  => 'required|integer|min:1',
                'bathrooms_number'  => 'required|integer|min:1',
                'square_meters'  => 'integer|min:1',
                'visible'  => 'required',
                'services'  => 'required',
                'tags'  => 'required',
            ],

            [
                'title.required' => 'Il titolo è un campo obbligatorio.',
                'title.string' => 'Il titolo deve essere una stringa.',
                'title.max' => 'Il limite massimo di caratteri per il titolo è 100.',
                'title.unique' => 'Il titolo selezionato già esiste, provane un altro.',

                'habitation_type_id.required' => 'La tipologia di struttura è un campo obbligatorio.',

                'description.required' => 'La descrizione è un campo obbligatorio.',
                'description.string' => 'La descrizione deve essere una stringa.',

                'price.required' => "Inserisci il prezzo per una singola notte.",
                'price.integer' => "Il prezzo deve essere un numero.",
                'price.between' => "Il prezzo deve essere compreso tra 1 e 25000.",

                'address.required' => "L'indirizzo è un campo obbligatorio.",
                'address.string' => "L'indirizzo deve essere una stringa.",

                'guests_number.required' => 'Il numero massimo di ospiti è un campo obbligatorio.',
                'guests_number.integer' => 'Inserisci un numero per stabilire la quantità massima di ospiti.',
                'guests_number.min' => 'Il numero minimo previsto per gli ospiti è 1.',

                'rooms_number.required' => 'Il numero di stanze è un campo obbligatorio.',
                'rooms_number.integer' => 'Inserisci un numero per stabilire la quantità di stanze.',
                'rooms_number.min' => 'Il numero minimo previsto per le stanze è 1.',

                'beds_number.required' => 'Il numero di letti è un campo obbligatorio.',
                'beds_number.integer' => 'Inserisci un numero per stabilire la quantità di letti.',
                'beds_number.min' => 'Il numero minimo previsto per i letti è 1.',

                'bathrooms_number.required' => 'Il numero di bagni è un campo obbligatorio.',
                'bathrooms_number.integer' => 'Inserisci un numero per stabilire la quantità di bagni.',
                'bathrooms_number.min' => 'Il numero minimo previsto per i bagni è 1.',

                'square_meters.integer' => 'Inserisci un numero per definire i metri quadrati della struttura.',
                'square_meters.min' => 'Il numero minimo previsto per i metri quadrati è 1.',

                'services.required' => 'Inserisci almeno un servizio presente nella struttura',

                'tags.required' => 'Inserisci almeno una caratteristica della struttura',
                ]
        );

        $habitation->slug = Str::slug($data['title'], '-');

        // recupero di lat e long
        $apiKey = "oXUZAxmXyTAodB2lLDjVxMGJQhcbFGUl";
        $address = $data['address'];
        $address = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key={$apiKey}&limit=5&countrySet=IT&language=it-IT";
        $response_json = file_get_contents($url);
        $response = json_decode($response_json, true);

        // inserimento lat e lot nel rispettivo record
        $habitation->latitude = $response['results'][0]['position']['lat'];
        $habitation->longitude = $response['results'][0]['position']['lon'];


        if (array_key_exists('image', $data)) {
            $files = $data['image'];

            foreach ($files as $file) {


                $new_image = new Image();

                $image_url = Storage::put('habitations_images', $file);

                $new_image->image_url = $image_url;
                $new_image->habitation_id = $habitation->id;

                $new_image->save();

            }
        };

        if (array_key_exists('tags', $data)) {

            $habitation->tags()->sync($data['tags']);
        }

        if (array_key_exists('services', $data)) {

            $habitation->services()->sync($data['services']);
        }


        $habitation->update($data);

        return redirect()->route('admin.habitations.show', $habitation)->with('message', "L'annuncio <strong>$habitation->title</strong> è stato modificato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitation $habitation)
    {

        if (Auth::user()->id == $habitation->user_id) {
            $habitation->delete();
            return redirect()->route( 'admin.habitations.index' )->with('message', "<strong>$habitation->title</strong> è stato eliminato con successo.");

        } return view('admin.pages.notFound');

    }
}
