<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Habitation;
use App\Models\Service;

use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class HabitationApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Zero sponsor
        $habitations= Habitation::orderBy('updated_at', 'DESC')->where('visible', 1)->with('services', 'tags', 'habitationType', 'images', 'sponsorships')->get();

        $habsNoSponsor = [];

        foreach ($habitations as $habitation) {

            if ($habitation->sponsorships()->count() == 0) {
                array_push($habsNoSponsor, $habitation);
            }
        }

        // Sponsor scaduti
        $currentDate = Carbon::now('Europe/Rome')->toDateTimeString();

        $expiredSponsorHabs = Habitation::whereHas('sponsorships', function ($query) use ($currentDate){
            $query->where('end_date', '<=', $currentDate);
           })->where('visible', 1)->with('sponsorships', 'images')->get();

           foreach ($expiredSponsorHabs as $expiredSponsorHab) {
                array_push($habsNoSponsor, $expiredSponsorHab);
            }   
        
        return response()->json(compact('habsNoSponsor'));
    }

    public function getSponsored()
    {
        $currentDate = Carbon::now('Europe/Rome')->toDateTimeString();

        $sponsoredHabs = Habitation::whereHas('sponsorships', function ($query) use ($currentDate){
            $query->where('end_date', '>=', $currentDate);
           })->where('visible', 1)->with('sponsorships', 'images')->get();

        return response()->json(compact('sponsoredHabs'));
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
        $minBeds = $data['minBeds'];
        $minRooms = $data['minRooms'];


        if (isset($data['services'])) {
            $explodedServices = explode(',', $data['services']);
        } else {
            $explodedServices = [];
        }


        $habitations = Habitation::orderBy('updated_at', 'DESC')
                                    ->where('visible', 1)
                                    ->where('beds_number', '>=', $minBeds)
                                    ->where('rooms_number', '>=', $minRooms)
                                    ->where(function ($query) use ($explodedServices) {

                                        if (array_key_exists(0, $explodedServices)) {

                                            foreach ($explodedServices as $service) {

                                                $query->whereHas('services', function ($q) use ($service) {
                                                    $q->where('service_id', $service);
                                                });
                                            }
                                        }

                                    })
                                    ->with('services', 'tags', 'habitationType', 'images', 'sponsorships')->get();


        $filteredHab = [];

        foreach ($habitations as $habitation) {
            $distance = self::haversineGreatCircleDistance($latitude, $longitude, $habitation->latitude, $habitation->longitude);

            $kmRadius = $radius / 1000;

            if ($distance < $kmRadius ) {
                array_push($filteredHab, $habitation);

            }

        }
        return response()->json(compact('filteredHab'));
    }

    public function getServices(){
        $services= Service::orderBy('label', 'ASC')->get();

        return response()->json(compact('services'));
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
