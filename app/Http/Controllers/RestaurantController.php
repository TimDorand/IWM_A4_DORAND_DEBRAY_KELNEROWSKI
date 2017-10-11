<?php

namespace App\Http\Controllers;

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
        /*$data = $request->all(); // This will get all the request data.

        dd($data); // This will dump and die

        if (isset($_POST['lat'], $_POST['lng'])) {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];

            $url = sprintf("https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s", $lat, $lng);

            $content = file_get_contents($url); // get json content

            $metadata = json_decode($content, true); //json decoder

            if (count($metadata['results']) > 0) {
                // for format example look at url
                // https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452
                $result = $metadata['results'][0];

                // save it in db for further use
                echo $result['formatted_address'];

            } else {
                // no results returned
            }
        }*/

        $response = Curl::to("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=" . $_POST['lat'] . "," . $_POST['lng'] . "&radius=750&type=restaurant&key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk")
            ->get();
        return $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $tags = Tag::all();
        dd(Tag::all());
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
