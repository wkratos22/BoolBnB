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

        if ($user_hab->count() >= 1) {

            $habitations = $user_hab->get();

            return view('admin.habitations.index', compact('habitations'));
        } else {
            return redirect('/');
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
                'image'  => 'required|array',
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

                'image.required' => "Inserisci almeno un'immagine associata alla struttura.",

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
        
        // if ($request->hasFile('image')) {
        //     $files = $request->file('image');
            
        //     foreach ($files as $file) {
        //         $filename = $file->getClientOriginalName();
        //         $extension = $file->getClientOriginalExtension();
        //         $customName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;

        //         $image_url = Storage::put('habitations_images', $file);
        //     }
        // }

        if (array_key_exists('image', $data)) {
            $files = $data['image'];

            foreach ($files as $file) {

                $image_url = Storage::put('habitations_images', $file);
            }
        }

        $new_habitation->save();

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
