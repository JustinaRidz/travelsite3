<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller{
    public function index(Request $request){
        if (isset($request->country_id) && $request->country_id !== 0)
            $customers = \App\Customer::where('country_id', $request->country_id)->orderBy('surname')->get();
        else
            $customers = \App\Customer::orderBy('surname')->get();
        $countries = \App\Country::orderBy('title')->get();
        return view('customers.index', ['customers' => $customers, 'countries' => $countries]);
    }
    public function create(){
        $countries = \App\Country::orderBy('title')->get();
        return view('customers.create', ['countries' => $countries]);
    }
    public function store(Request $request){
        $customer = new Customer();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customers.index');
    }
    public function show(Customer $customer){
        //
    }
    public function edit(Customer $customer){
        $countries = \App\Country::orderBy('title')->get();
        return view('customers.edit', ['customer' => $customer, 'countries' => $countries]);
    }
    public function update(Request $request, Customer $customer){
        $customer->fill($request->all());
        $customer->save();
        return redirect()->route('customers.index');
    }
    public function destroy(Customer $customer, Request $request){
        $customer->delete();
        return redirect()->route('customers.index', ['country_id' => $request->input('country_id')]);
    }
}
