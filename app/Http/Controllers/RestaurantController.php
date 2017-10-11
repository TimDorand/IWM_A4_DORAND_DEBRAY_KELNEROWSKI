<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Tag;
use Illuminate\Http\Request;
use Ixudra\Curl\CurlService;
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
        try{

        $restaurantsGoogle = Curl::to("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=48.890982,2.239759&radius=750&type=restaurant&key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk")->get();

        $restaurantsSQL = Restaurant::all();

        $restaurantsSQLOrdered = array();

        foreach ($restaurantsSQL as $restaurant){
            $restaurantsSQLOrdered[$restaurant->g_id] = $restaurant;
        }

        $restaurantsGoogle = json_decode($restaurantsGoogle)->results;

        foreach ($restaurantsGoogle as $restaurant) {
            if (isset($restaurantsSQLOrdered[$restaurant->id])) {

            }
            else{
                $insertRestaurant = new Restaurant;

                $insertRestaurant->lat = $restaurant->geometry->location->lat;
                $insertRestaurant->lng = $restaurant->geometry->location->lng;
                $insertRestaurant->g_id = $restaurant->id;
                $insertRestaurant->name = $restaurant->name;
                $insertRestaurant->icon = $restaurant->icon;
                $insertRestaurant->infos = $restaurant->vicinity;

                $insertRestaurant->save();
            }
        }
        } catch(Exception $e){
            return $e;
        }

        return $restaurantsGoogle;
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
}
