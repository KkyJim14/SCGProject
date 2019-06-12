<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        // Set Url Path to Send Request 
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=Bangsue&key=AIzaSyCxWJuVBao6hFOx__vGQdzLsFnGZ7jfnlw';

        // Use GuzzleHttp
        $client = new \GuzzleHttp\Client();

        // Send a request
        $geocodeResponse = $client->get( $url )->getBody();

        // Decode Json Data
        $geocodeData = json_decode( $geocodeResponse );

        // Get Lattitude of a location
        $lat = $geocodeData->results[0]->geometry->location->lat;

        // Get Longtitude of a location
        $lng = $geocodeData->results[0]->geometry->location->lng;

        // Set a second Path to find a restaurant around Location we have get first
        $place = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=restaurant&location='.$lat.','.$lng.'&rankby=distance&key=AIzaSyCxWJuVBao6hFOx__vGQdzLsFnGZ7jfnlw';

        // Call a Guzzle Http Function
        $get = new \GuzzleHttp\Client();

        // Send a request
        $geocodeResponse_2nd = $client->get( $place )->getBody();

        // Decode Json Data
        $geocodeData_2nd = (array) json_decode( $geocodeResponse_2nd );
        
        // Check if there is a cache
        if(Cache::has('Bangsue')) {
            // Return a Cache Data
            $cache = Cache::get('Bangsue');
            // Return a result as a json
            return response()->json($cache);
        }
        // No Cache file on this keyword
        else {
            // Store a cache file
            Cache::put('Bangsue', $geocodeData_2nd, 10);
            // Return a result as a json
            return response()->json($geocodeData_2nd);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        // Set Url Path to Send Request 
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$request->get('destination').'&key=AIzaSyCxWJuVBao6hFOx__vGQdzLsFnGZ7jfnlw';

        // Use GuzzleHttp
        $client = new \GuzzleHttp\Client();

        // Send a request
        $geocodeResponse = $client->get( $url )->getBody();

        // Decode Json Data
        $geocodeData = json_decode( $geocodeResponse );

        // Get Lattitude of a location
        $lat = $geocodeData->results[0]->geometry->location->lat;

        // Get Longtitude of a location
        $lng = $geocodeData->results[0]->geometry->location->lng;

        // Set a second Path to find a restaurant around Location we have get first
        $place = 'https://maps.googleapis.com/maps/api/place/textsearch/json?query=restaurant&location='.$lat.','.$lng.'&rankby=distance&key=AIzaSyCxWJuVBao6hFOx__vGQdzLsFnGZ7jfnlw';

        // Use GuzzleHttp
        $get = new \GuzzleHttp\Client();

        // Send a request
        $geocodeResponse_2nd = $client->get( $place )->getBody();

        // Decode Json Data
        $geocodeData_2nd = (array) json_decode( $geocodeResponse_2nd );

        // Check if there is a cache
        if(Cache::has($request->get('destination'))) {
            // Return a Cache Data
            $cache = Cache::get($request->get('destination'));
            // Return data as a json
            return response()->json($cache);
        }
        else {
            // Store a cache file
            Cache::put($request->get('destination'), $geocodeData_2nd, 10);
            // Return data as a json
            return response()->json($geocodeData_2nd);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        
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
