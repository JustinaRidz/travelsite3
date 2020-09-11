<?php

namespace App\Http\Controllers;

use App\Town;
use Illuminate\Http\Request;

class TownController extends Controller{
    public function index(){
        return view('towns.index', ['towns' => Town::orderBy('title')->get()]);
    }
    // ATTENTION :: we need countries to be able to assign them
    public function create(){
        $countries = \App\Country::orderBy('title')->get();
        return view('towns.create', ['countries' => $countries]);
    }
    public function store(Request $request){
        $town = new Town();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $town->fill($request->all());
        $town->save();
        return redirect()->route('town.index');
    }
    public function show(Town $town){
        //
    }
    // ATTENTION :: we need countries to be able to assign them
    public function edit(Town $town){
        $countries = \App\Country::orderBy('title')->get();
        return view('towns.edit', ['town' => $town, 'countries' => $countries]);
    }
    public function update(Request $request, Town $town){
        $town->fill($request->all());
        $town->save();
        return redirect()->route('town.index');
    }
    public function destroy(Town $town){
        $town->delete();
        return redirect()->route('town.index');
    }
}
