<?php

namespace App\Http\Controllers;

use App\Rate;
use App\Restaurant;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;
use Mockery\CountValidator\Exception;

class RestaurantController extends Controller
{

    /**
     * Get the address of the current User location
     *
     */
    public function maps()
    {
        try {
            $restaurantsGoogle = Curl::to("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $_POST['lat'] . "," . $_POST['lng'] . "&radius=750&type=food&key=AIzaSyAt_mclmdnLk7Fvzza-SW72yFbNvv7wxC4")
                ->get();
        }
        catch (Exception $err){
            // Logs Google API failure
        }

        /*   $restaurantsSQL = DB::select(
               'SELECT * FROM
                       (SELECT *, (3959 * acos(cos(radians(' . $_POST['lat'] . ')) * cos(radians(lat)) *
                       cos(radians(lng) - radians(' . $_POST['lng'] . ')) +
                       sin(radians(' . $_POST['lat'] . ')) * sin(radians(lat))))
                       AS distance
                       FROM restaurants
                       INNER JOIN rates ON restaurants.id=rates.restaurant_id
                       ) AS distances
                   WHERE distance < 1
                   ORDER BY distance
           ');
   **/
        $restaurantsSQL = DB::table("restaurants")
            ->select("*"
                ,DB::raw("6371 * acos(cos(radians(" . $_POST['lat'] . ")) 
		* cos(radians(restaurants.lat)) 
		* cos(radians(restaurants.lng) - radians(" . $_POST['lng'] . ")) 
		+ sin(radians(" .$_POST['lat']. ")) 
		* sin(radians(restaurants.lat))) AS distance"))
            ->having('distance', '<', 0.75)
            ->get();

        $restaurantsSQLOrdered = array();
        $results = array();

        foreach ($restaurantsSQL as $restaurant){
            $restaurantsSQLOrdered[$restaurant->g_id] = $restaurant;
            $count = new \stdClass();
            $restaurant->rate = new \stdClass();
            $rates =  DB::table('rates')->where('restaurant_id', '=', $restaurant->id)->get();

            foreach ($rates as $rate) {
                if(!isset($restaurant->rate->{$rate->tag_id})) $restaurant->rate->{$rate->tag_id} = 0;
                if(!isset($count->{$rate->tag_id})) $count->{$rate->tag_id} = 0;

                $restaurant->rate->{$rate->tag_id} = round(($restaurant->rate->{$rate->tag_id}* $count->{$rate->tag_id} + $rate->rate) / ($count->{$rate->tag_id} + 1) * 2) / 2;
                $count->{$rate->tag_id}++;
            }
            array_push($results, $restaurant);
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
                    if(isset($restaurant->photos[0]->photo_reference)){
                        $insertRestaurant->photo_reference = $restaurant->photos[0]->photo_reference;
                    }else{
                        $insertRestaurant->photo_reference = null;
                    }

                    $insertRestaurant->save();

                    $rest = new \stdClass();
                    $rest->lat = $restaurant->geometry->location->lat;
                    $rest->lng = $restaurant->geometry->location->lng;
                    if(isset($restaurant->photos[0]->photo_reference)){
                        $rest->photo_reference = $restaurant->photos[0]->photo_reference;
                    }else{
                        $rest->photo_reference = null;
                    }
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

        $tags = Tag::all();
//        $tags = [];
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
