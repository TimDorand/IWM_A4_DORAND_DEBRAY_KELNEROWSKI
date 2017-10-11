<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Curl::to("https://maps.googleapis.com/maps/api/place/radarsearch/json?location=" . $_POST['lat'] . "," . $_POST['lng'] . "&radius=10&type=restaurant&key=AIzaSyAg4AuvoQ6ZF5uxqpjliVxYACAdAWvbvDk")
            ->get();
        return $response;
    }
}
