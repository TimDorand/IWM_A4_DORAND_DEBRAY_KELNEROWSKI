<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(count($request['rates']) > 0){
            foreach($request['rates'] as $single_rate){
                $rate = new Rate;
                $rate->rate = $single_rate->rate;
                $rate->user_id = Auth::user()->id;
                $rate->rest_id = $single_rate->rest_id;
                $rate->tag_id= $single_rate->tag_id;
                $rate->save();
            }
        }else{
            return redirect()->route('restaurant.index')->with('error', 'Veuillez entrer au moins un avis !');
        }
        return redirect()->route('restaurant.index')->with('success', 'Votre commentaire à bien été pris en compte !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
