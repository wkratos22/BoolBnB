<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habitation;

use Illuminate\Support\Facades\Validator;

class HabitationApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitations= Habitation::orderBy('updated_at', 'DESC')->where('visible', 1)->with('services', 'tags', 'habitationType', 'images')->get();

        return response()->json(compact('habitations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $habitation = Habitation::where('slug', $slug)->with('services', 'tags', 'habitationType', 'images')->first();

        if(!$habitation) return response('Post not found', 404);

        return response()->json($habitation);
    }

    public function getParams( Request $request ){
        $data= $request->all();

        $longitude = $data['lon'];
        $latitude = $data['lat'];
        $radius = $data['radius'];

        $habitations = Habitation::orderBy('updated_at', 'DESC')->where('visible', 1)->with('services', 'tags', 'habitationType', 'images')->get();

        $filteredHab = [];

        foreach ($habitations as $habitation) {
            $distance = self::haversineGreatCircleDistance($latitude, $longitude, $habitation->latitude, $habitation->longitude);
            $kmRadius = $radius / 1000;
            if ($distance < $kmRadius) {
                array_push($filteredHab, $habitation);
            }

        }
        
        return response()->json(compact('filteredHab'));

    }

    // metodo php per calcolare la distanza tra due diversi punti (definiti tramite lat e long)
    public function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthMeanRadius = 6371
    ) 
    {
        $deltaLatitude = deg2rad($latitudeTo - $latitudeFrom);
        $deltaLongitude = deg2rad($longitudeTo - $longitudeFrom);
        $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) +
            cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) *
            sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthMeanRadius * $c;
    }

}
