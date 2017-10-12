<?php

namespace App\Http\Controllers;

use App\Rate;
use App\Restaurant;
use App\Tag;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
use Ixudra\Curl\Facades\Curl;

class RestaurantController extends Controller
{

    /**
     * Get the address of the current User location
     *
     */
    public function maps()
    {
        try {
            $restaurantsGoogle = Curl::to("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $_POST['lat'] . "," . $_POST['lng'] . "&radius=750&type=restaurant&key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk")
                ->get();
        }
        catch (Exception $err){
            // Logs Google API failure
        }

        $restaurantsSQL = Restaurant::all();

        $restaurantsSQLOrdered = array();
        $results = array();

        foreach ($restaurantsSQL as $restaurant){
            $restaurantsSQLOrdered[$restaurant->g_id] = $restaurant;
            if($this->distance($_POST['lat'],$_POST['lng'],$restaurant->lat, $restaurant->lng) < 0.75) {
                $rates = Rate::where("rest_id", $restaurant->g_id);
                foreach ($rates as $rate) {
                    $restaurant[$rate->tag_id] += $rate->rate;
                }

                array_push($results, $restaurant);
            }
        }

        if(isset($restaurantsGoogle)){
            $restaurantsGoogle = json_decode($restaurantsGoogle)->results;

            foreach ($restaurantsGoogle as $restaurant) {
                if (!isset($restaurantsSQLOrdered[$restaurant->id])) {
                    $insertRestaurant = new Restaurant;

                    $insertRestaurant->lat = $restaurant->geometry->location->lat;
                    $insertRestaurant->lng = $restaurant->geometry->location->lng;
                    $insertRestaurant->g_id = $restaurant->id;
                    $insertRestaurant->name = $restaurant->name;
                    $insertRestaurant->icon = $restaurant->icon;
                    $insertRestaurant->infos = $restaurant->vicinity;
                    $insertRestaurant->types = json_encode($restaurant->types);

                    $insertRestaurant->save();

                    $rest = new \stdClass();
                    $rest->lat = $restaurant->geometry->location->lat;
                    $rest->lng = $restaurant->geometry->location->lng;
                    $rest->g_id = $restaurant->id;
                    $rest->name = $restaurant->name;
                    $rest->icon = $restaurant->icon;
                    $rest->infos = $restaurant->vicinity;
                    $rest->types = json_encode($restaurant->types);

                    array_push($results, $rest);
                }
            }
        }
        return $results;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $tags = Tag::all();

        $tags = [];
        return view('main')->with(compact('tags'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        //rayon de la terre
        $r = 6366;
        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);
        $lon1 = deg2rad($lon1);
        $lon2 = deg2rad($lon2);

        //calcul précis
        $dp= 2 * asin(sqrt(pow (sin(($lat1-$lat2)/2) , 2) + cos($lat1)*cos($lat2)* pow( sin(($lon1-$lon2)/2) , 2)));

        //sortie en km
        $d = $dp * $r;

        $h = sqrt(pow($d,2));

        return $h;
    }
}
