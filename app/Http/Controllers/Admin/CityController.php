<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index(){
        $cities = City::get();
        return view('admin.city.index', compact('cities'));
    }

    public function edit(Request $request){
        $city = City::find($request->id);

        return view('admin.city.edit', compact('city'));
    }

    public function create(){
        return view('admin.city.create');
    }
    public function delete(Request $request){
        dd($request);
        return 1;
    }

    public function save(Request $request){
        dd($request);
    }
    public function update(Request $request){
        dd($request);
    }
}
