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

class HabitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_hab = Auth::user()->habitations();

        $habitations = $user_hab->orderBy('updated_at', 'desc')->get();

        return view('admin.habitations.index', compact('habitations'));
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
                'title'  => 'required|max:100|unique:habitations',
                'habitation_type_id' => 'required',
                'description'  => 'required',
                'price'  => 'required|numeric|between:1,99999.99',
                'address'  => 'required',
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude'  => 'required|numeric|between:-180,180',
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
                'title.max' => 'Il limite massimo di caratteri per il titolo è 100.',
                'title.unique' => 'Il titolo selezionato già esiste, provane un altro.',

                'habitation_type_id.required' => 'La tipologia di struttura è un campo obbligatorio.',

                'description.required' => 'La descrizione è un campo obbligatorio.',

                'address.required' => "L'indirizzo è un campo obbligatorio.",

                'latitude.required' => 'La latitudine è un campo obbligatorio.',
                'latitude.numeric' => 'Inserisci un numero per definire la latitudine.',
                'latitude.between' => 'La latitudine è compresa tra -90 e 90.',

                'longitude.required' => 'La longitudine è un campo obbligatorio.',
                'longitude.numeric' => 'Inserisci un numero per definire la longitudine.',
                'longitude.between' => 'La longitudine è compresa tra -180 e 180.',

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

        $data = $request->all();

        // dd($data);

        $new_habitation = new Habitation();

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


        return redirect()->route('admin.habitations.show', $new_habitation)->with('message', "L'annuncio '$new_habitation->title' è stato creato con successo!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Habitation $habitation)
    {

        return view('admin.habitations.show', compact('habitation'));
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

        return view('admin.habitations.edit', compact('habitation', 'habitation_tags_id', 'habitation_services_id', 'type_hab', 'tags_hab', 'service_hab'));
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
                'title'  => 'required|max:100|unique:habitations,title,'.$habitation->id,
                'habitation_type_id' => 'required',
                'description'  => 'required',
                'price'  => 'required|numeric|between:1,99999.99',
                'address'  => 'required',
                'latitude'  => 'required|numeric|between:-90,90',
                'longitude'  => 'required|numeric|between:-180,180',
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
                'title.max' => 'Il limite massimo di caratteri per il titolo è 100.',
                'title.unique' => 'Il titolo selezionato già esiste, provane un altro.',

                'habitation_type_id.required' => 'La tipologia di struttura è un campo obbligatorio.',

                'description.required' => 'La descrizione è un campo obbligatorio.',

                'address.required' => "L'indirizzo è un campo obbligatorio.",

                'latitude.required' => 'La latitudine è un campo obbligatorio.',
                'latitude.numeric' => 'Inserisci un numero per definire la latitudine.',
                'latitude.between' => 'La latitudine è compresa tra -90 e 90.',

                'longitude.required' => 'La longitudine è un campo obbligatorio.',
                'longitude.numeric' => 'Inserisci un numero per definire la longitudine.',
                'longitude.between' => 'La longitudine è compresa tra -180 e 180.',

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


        return redirect()->route('admin.habitations.show', $habitation)->with('message', "L'annuncio '$habitation->title' è stato modificato con successo!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitation $habitation)
    {
        $habitation->delete();

        return redirect()->route( 'admin.habitations.index' )->with('message', "$habitation->title è stato eliminato con successo.");
    }
}
